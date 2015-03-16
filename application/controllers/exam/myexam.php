<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Myexam extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('exammodel');
        $this->load->model('examprofilemodel');
        $this->load->model('examineemodel');
        $this->load->model('invigilatormodel');
        $this->load->model('resultmodel');
        $this->load->model('loggermodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
    }

    function buildexam($id) {

        $examinee = $this->examineemodel->getexaminee($id);
        //echo $examinee[0]['finishtime'];
        if ($examinee[0]['finishtime'] != "0000-00-00 00:00:00") {
            redirect('exam/myexam/endexam/' . $id);
        }

        $data['examinee'] = $examinee;

        if (strlen($examinee[0]['qseq']) === 0) {
            $profilename = $examinee[0]['examprofile'];
            //get an array of the examprofile subtests
            $profile = $this->exammodel->getprofile($profilename);

            //for each subtest get the question id's
            $qseq = "";
            foreach ($profile as $row) {
                $diff = FALSE;
                while (!$diff) {
                    //echo $row['subtest'];
                    $ques = $this->exammodel->getexamques($row['subtest'], $row['numques']);
                    //test the difficulty and keep looping until the difficulty meets the criteria
                    $diff = $this->exammodel->testdifficulty($ques, $row['targetdifficulty'], $row['range']);
                }

                $qseq = $qseq . $this->exammodel->quesseq($ques);
            }
            $qseq = rtrim($qseq, ",");
            $this->exammodel->postqseq($id, $qseq);
            $this->resultmodel->initializeanswers($id, $qseq);
            $this->loggermodel->log($id, 'exam sequence built for ' . $examinee[0]['fname'] . ' ' . $examinee[0]['lname']);
        }

        $hdata['pagetitle'] = $examinee[0]['fname'] . " " . $examinee[0]['lname'] . " Exam Instructions";
        $this->load->view('site/header', $hdata);
        $this->load->view('admin/exams/intro', $data);
        $this->load->view('site/footer');
    }

    function getques($qid) {
        $ques = $this->exammodel->getques($qid);
        return $ques;
    }

    function poststarttime($id) {
        $this->examineemodel->poststarttime($id);
        redirect("/exam/myexam/examprep/" . $id);
    }

    function examprep($id) {
        $examinee = $this->examineemodel->getexaminee($id);
        $data['name'] = $examinee[0]['fname'] . " " . $examinee[0]['lname'];
        $data['examprofile'] = $examinee[0]['examprofile'];
        $data['tottime'] = $examinee[0]['tottime'] - $examinee[0]['elapsedtime'];

        $this->loggermodel->log($id, 'exam started for ' . $data['name']);

        $quesarray = $this->presentquesarray($id);
        $answerarray = $this->presentanswerarray($id);
        $this->quescontrol($data, $quesarray, $answerarray, $id);
    }

    function presentquesarray($id) {

        $examinee = $this->examineemodel->getexaminee($id);
        $quesstring = $examinee[0]['qseq'];
        //$quesarray = explode(",", $quesstring);
        //echo $qseq;
        $quesarray = $this->exammodel->buildquesarray($quesstring);
        //echo var_dump($quesarray);
        return $quesarray;
    }

    function presentanswerarray($id) {
        $answerarray = $this->resultmodel->answerarray($id);
        return $answerarray;
    }

    function quescontrol($data, $quesarray, $answerarray, $id) {
//        $this->testforinvig();
//        $this->session->sess_destroy();

        $hdata['pagetitle'] = $data['name'] . " " . $data['examprofile'] . " Exam";
        //$quesarray = $this->presentquesarray($id);
        //echo var_dump($quesarray);

        $data['ques'] = $quesarray;
        $data['answers'] = $answerarray;
        $data['id'] = $id;
        //echo var_dump($answerarray);
        //$data['qnum']= $qid;
        $data['maxqnum'] = count($quesarray);

        $this->load->view('site/header', $hdata);
        //$this->load->view('admin/exams/exammenu');
        $this->load->view('admin/exams/exam', $data);
        $this->load->view('site/footer');

        //$qid = $this->input->post('qnum');
        //}while(!$end);
    }

    function postanswer($id, $qnum, $answer) {
        //echo "hello from postanswer" . $id . $qnum . $answer;

        $this->resultmodel->updateanswer($id, $qnum, $answer);
    }

    function posttime($id) {
        //function posttime() {
        //$id = $this->input->post('id');
        //echo $id;
        $remtime = $this->examineemodel->posttime($id);
        echo $remtime;
        return $remtime;
    }

    function testforinvig() {
        if ($this->session->userdata('role') != 'invig') {
            redirect('main/logout');
        }
    }

    function postfinishtime($id) {
        $this->examineemodel->postfinishtime($id);
        $this->sendexamineecompleteemail($id);
        //$this->endexam($id);
        $this->invigilatorcomments($id);
    }

    function endexam($id) {
        $hdata['pagetitle'] = "Exam Finished";
        $this->load->view('site/header', $hdata);
        $this->load->view('admin/exams/finishexam');
        $this->load->view('site/footer');
        redirect('exam/myexam/invigilatorcomments/' . $id);
    }

    function invigilatorcomments($id) {

        $examinee = $this->examineemodel->getexaminee($id);
        //echo var_dump($examinee);
        $invigilator = $this->invigilatormodel->getinvigilator($examinee[0]['invigilatorID']);
        //echo var_dump($invigilator);
        $hdata['pagetitle'] = "Invigilator Sign-Off";
        //$data['examinee'] = $examinee;
        $data['examineename'] = $examinee[0]['fname'] . " " . $examinee[0]['lname'];
        $data['invigilator'] = $invigilator;
        $data['eid'] = $examinee[0]['id'];

        $this->load->view('site/header', $hdata);
        $this->load->view('admin/exams/invigcomments', $data);
        $this->load->view('site/footer');

        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $comments = $this->input->post('comments');
        $invig = $this->invigilatormodel->validateinvigilator($username, $password);

        if ($invig != false) {
            $this->examineemodel->postcomments($id, $comments);
            $this->session->sess_destroy();
            redirect('main/logout');
        }        
    }

    function scoreexam($id) {
        $score = $this->exammodel->scoreexam($id);
        return $score;
    }

    function getresults($id) {
        $examinee = $this->examineemodel->getexaminee($id);
        $results = $this->exammodel->getresults($id);
        $score = $this->scoreexam($id);
        $data['results'] = $results;
		$data['examprofile'] = $examinee[0]['examprofile'];
		$data['id']=$id;
        //echo var_dump($results);
        $data['score'] = $score;
        //echo var_dump($score);
        //echo var_dump($data['results']);
        $hdata['pagetitle'] = "Exam Results for " . $examinee[0]['fname'] . " " . $examinee[0]['lname'];

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/examinees/examresults', $data);
        $this->load->view('site/footer');

        // echo var_dump($results);
    }

    function sendexamineecompleteemail($id) {
		//$ADMINEMAIL = "info@ctcma.bc.ca";
		$ADMINEMAIL = "marknden@gmail.com";
        $score = $this->scoreexam($id);
        $result = $this->examineemodel->getexaminee($id);
        $invig = $this->invigilatormodel->getinvigilator($result[0]['invigilatorID']);
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
		$regnum = $result[0]['regnum'];
		$examprofile = $result[0]['examprofile'];
		//$edate = $result[0]['examdate'];
		//$estartdate = date('Y-m-d', strtotime($edate) - 3 * 24 * 60 * 60);
		//$eenddate = date('Y-m-d', strtotime($edate) + 3 * 24 * 60 * 60);
		$date =  date('Y-m-d', time());
        $username = $this->session->userdata('name');
        $subject = "CTCMABC Safety Examination Is Complete";
		if ($score['passfail'] == 'pass'){
        	$message = "Dear " . $name . ", ". $regnum . 
				"</br></br>Congratulations! You have successfully completed the Safety Examination for ". $examprofile .", which is one of the requirements 
				for registration in the Province.
				</br></br>issued this: ". $date;
		}else{
			$message= "Dear " . $name . ", ". $regnum . 
				"</br></br>You are unsuccessful in the Safety Examination for ". $examprofile .", which is one of the requirements 
				for registration in the Province. 
				</br></br>Please refer to the Safety Examination Guide for the policy on retaking an examination. 
				</br></br>issued this: ". $date;
		}
        $to = $result[0]['email'];
        $cc = $ADMINEMAIL;
        //echo $to;
        $this->mailhelper->sendmail($to, $cc, $subject, $message);
        $this->loggermodel->log($username, 'Examinee ' . $name . " exam complete email sent by " . $username);
    }

}

?>

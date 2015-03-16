<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Testing extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('examineemodel');
        $this->load->model('exammodel');
        $this->load->model('testingmodel');
        $this->load->model('invigilatormodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('session');
    }

    function index() {
        $hdata['pagetitle'] = "TESTING";
        $this->load->view('site/header', $hdata);
        $this->load->view('admin/testing/usermenu');
        $this->load->view('site/footer');
    }

    function deleteexaminees() {
        $this->testingmodel->deleteexaminees();
        redirect('admin/examinees/listexaminees');
    }

    function gentestexaminees() {
        $this->testingmodel->gentestexaminees();
        redirect('admin/examinees/listexaminees');
    }
    
    function deleteresults(){
        $this->testingmodel->deleteresults();
        redirect('admin/examinees/listexaminees');
    }

    function listexaminees() {
        $hdata['pagetitle'] = "List Examinees";
        $data['listexaminees'] = $this->examineemodel->listexamineesns();

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/testing/usermenu');
        $this->load->view('admin/examinees/listexaminees', $data);
        $this->load->view('site/footer');
    }

//    function generateexamquestions(){
//        //$this->exammodel->deleteexamquestions();
//        $this->testingmodel->generateexamquestions();
//        redirect('admin/testing/listexamquestions');
//    }

    function listexamquestions() {
        $hdata['pagetitle'] = "List Exam Questions";
        $data['listexamquestions'] = $this->exammodel->listexamquestionsns();

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/testing/usermenu');
        $this->load->view('admin/testing/listexamquestions', $data);
        $this->load->view('site/footer');
    }

    function quesdetail($subtest, $qnum) {
        $hdata['pagetitle'] = "Question Detail";
        $data['examques'] = $this->exammodel->getexamques($subtest, $qnum);
        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/testing/usermenu');
        $this->load->view('admin/testing/quesdetail', $data);
        $this->load->view('site/footer');
    }

//    function deleteexamquestions(){
//        $this->testingmodel->deleteexamquestions();
//        redirect('admin/reports/listexamquestions');
//    }

    function deleteinvigilators() {
        $this->testingmodel->deleteinvigilators();
        redirect('admin/testing/listinvigilators');
    }

    function gentestinvigilators() {
        //echo "hello gentestinvigilators";
        $this->testingmodel->gentestinvigilators();
        redirect('admin/testing/listinvigilators');
    }

    function listinvigilators() {
        $hdata['pagetitle'] = "List Invigilators";
        $data['listinvigilators'] = $this->invigilatormodel->listinvigilators();

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/testing/usermenu');
        $this->load->view('admin/invigilators/listinvigilators', $data);
        $this->load->view('site/footer');
    }

    function buildexam($id) {
        //get the examprofile name
        $examinee = $this->examineemodel->getexaminee($id);
        $profilename = $examinee[0]['examprofile'];
        //echo $profilename;
        //get an array of the examprofile subtests
        $profile = $this->exammodel->getprofile($profilename);
        //echo var_dump($profile);
        //for each subtest get the question id's
        $qseq = "";
        foreach ($profile as $row) {
            $diff = FALSE;
            while (!$diff) {
                echo $row['subtest'];
                $ques = $this->exammodel->getexamques($row['subtest'], $row['numques']);
                $diff = $this->exammodel->testdifficulty($ques, $row['targetdifficulty'], $row['range']);
                echo "avg difficulty: " . $diff;
            }

            $qseq = $qseq . $this->exammodel->quesseq($ques);
        }
        echo $qseq;
        $this->exammodel->postqseq($id, $qseq);
    }


}

?>

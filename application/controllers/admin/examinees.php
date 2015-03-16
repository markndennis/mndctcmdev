<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examinees extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('examineemodel');
        $this->load->model('exammodel');
        $this->load->model('invigilatormodel');
        $this->load->model('loggermodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
        $this->testforadmin();
    }

    function index() {
        $this->testforadmin();
    }

    function addexaminee() {
        $this->testforadmin();
        $hdata['pagetitle'] = "Add Examinee";
        $data['invigs'] = $this->invigilatormodel->listinvigilators();

        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        //$this->form_validation->set_rules('regnum', 'Registration', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('exam', 'Exam', 'required');
        $this->form_validation->set_rules('agree', 'Declaration', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('site/adminhmenu');
            $this->load->view('admin/examinees/usermenu');
            $this->load->view('admin/examinees/addexamineeview', $data);
            $this->load->view('site/footer');
        } else {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $dob = $this->input->post('dob');
            $examdate = $this->input->post('examdate');
            $regnum = $this->input->post('regnum');
            $email = $this->input->post('email');
            $exam = $this->input->post('exam');
            $invigid = $this->input->post('invigid');
            $this->examineemodel->addexaminee($fname, $lname, $dob, $examdate, $regnum, $email, $exam, $invigid);
            $username = $this->session->userdata('name');
            $this->loggermodel->log($username, 'Examinee ' . $fname . " " . $lname . " added by " . $username);
            redirect('admin/examinees/listexaminees');
        }
    }

    function viewexaminee($id) {
        $this->testforadmin();
        $this->examineemodel->updatestatus();
        $result = $this->examineemodel->getexaminee($id);
        $data['result'] = $result;
        $data['invig'] = $this->invigilatormodel->listinvigilators();
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $hdata['pagetitle'] = "View Examinee " . $name;
        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/examinees/usermenu');
        $this->load->view('admin/examinees/viewexaminee', $data);
        $this->load->view('site/footer');
    }

    function editexaminee($id) {
        $this->testforadmin();
        $result = $this->examineemodel->getexaminee($id);
        $data['result'] = $result;
        $data['invig'] = $this->invigilatormodel->listinvigilators();
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $hdata['pagetitle'] = "Edit Examinee " . $name;
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        //$this->form_validation->set_rules('regnum', 'Registration', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('site/adminhmenu');
            $this->load->view('admin/examinees/usermenu');
            $this->load->view('admin/examinees/editexaminee', $data);
            $this->load->view('site/footer');
        } else {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $dob = $this->input->post('dob');
            $examdate = $this->input->post('examdate');
            $regnum = $this->input->post('regnum');
            $email = $this->input->post('email');
            //$exam = $result[0]['exam'];
            $astatus = $this->input->post('astatus');
            $invigid = $this->input->post('invigid');
            //echo var_dump($pin, $fname, $lname, $dob, $regnum, $email, $exam, $status, $invigid);
            $this->examineemodel->editexaminee($id, $fname, $lname, $dob, $examdate, $regnum, $email, $astatus, $invigid);
            $username = $this->session->userdata('name');
            $this->loggermodel->log($username, 'Examinee ' . $fname . " " . $lname . " edited by " . $username);
            redirect('admin/examinees/viewexaminee/' . $id);
        }
    }

    function listexaminees() {
        $this->testforadmin();
        $this->examineemodel->updatestatus();
        $hdata['pagetitle'] = "List Examinees";
        $data['listexaminees'] = $this->examineemodel->listexaminees();

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/examinees/usermenu');
        $this->load->view('admin/examinees/listexaminees', $data);
        $this->load->view('site/footer');
    }

    function sendexamineeapprovalemail($id) {
        $result = $this->examineemodel->getexaminee($id);
        if ($result[0]['astatus'] == "Approved") {
            $invig = $this->invigilatormodel->getinvigilator($result[0]['invigilatorID']);
            $ename = $result[0]['fname'] . " " . $result[0]['lname'];
            $iname = $invig[0]['fname'] . " " . $invig[0]['lname'];
            $edate = $result[0]['examdate'];
            $estartdate = date('Y-m-d', strtotime($edate) - 3 * 24 * 60 * 60);
            $eenddate = date('Y-m-d', strtotime($edate) + 3 * 24 * 60 * 60);
            $username = $this->session->userdata('name');
            $subject = "CTCMA Safety Examination Receipt/Confirmation";

            $message = "
Applicant Name: " . $ename . "<br>
Applicant Registration #: " . $result[0]['regnum'] . "<br>
Requested Examination Date: " . $edate . "<br>
Your Invigilator will be: " . $iname . "<br>
Examination Type: " . $result[0]['examprofile'] . "<br> 
Total Paid: $75.00<br><br>
Your Safety Examination application has been approved.<br><br>
Candidates must present a valid form of photo identification to the invigilator prior to being allowed to write an exam. This identification must be government issued (passport, drivers license, etc.)<br><br>
Electronic devices (i.e. iPods, cell phones, blackberries, etc.) are not allowed in the exam room.<br><br>
You will have " . $result[0]['tottime'] / 60 . " minutes to complete the examination. You must complete the examination without the use of notes or hand-held computers; however, you may access the Safety Program Handbook using the link provided on the examination site.<br><br>
Any fees pertaining to invigilation service are your responsibility.<br><br>
If you are unable to write the examination on your requested date, please inform your invigilator. You are required to write the examination within 2 days of the requested write date. A multiple
examination fee applies if an examination is not written and is subsequently re-requested.<br><br>
Further details on the examination policies and guidelines are available in the Safety Examination Guide (http://www.ctcma.bc.ca/assets/files/pdf_resources/Safety/Safety_Program_Examination_Guide-rev1.pdf).<br><br>
Good luck with your examination.<br><br>
This is an automated message, please do not reply. If you have any questions with this examination application, please contact the College at info@ctcma.bc.ca.";

            $to = $result[0]['email'];
            $cc = "mark@veritagroup.com,adam@veritagroup.com";
            //echo $to;
            $this->mailhelper->sendmail($to, $cc, $subject, $message);
            $this->loggermodel->log($username, 'Examinee ' . $ename . " approval email sent by " . $username);
            $this->sendexamineeapprovalemailinvig($id);
            //$this->viewexaminee($id);
        }
        redirect('admin/examinees/listexaminees');
    }

    function sendexamineeapprovalemailinvig($id) {
        $result = $this->examineemodel->getexaminee($id);
        $invig = $this->invigilatormodel->getinvigilator($result[0]['invigilatorID']);
        $ename = $result[0]['fname'] . " " . $result[0]['lname'];
        $iname = $invig[0]['fname'] . " " . $invig[0]['lname'];
        $edate = $result[0]['examdate'];
        $estartdate = date('Y-m-d', strtotime($edate) - 3 * 24 * 60 * 60);
        $eenddate = date('Y-m-d', strtotime($edate) + 3 * 24 * 60 * 60);
        $username = $this->session->userdata('name');
        $subject = "CTCMA Safety Examination Confirmation for " . $ename;

        $message = "
Dear " . $iname . "</br>
Candidate: " . $ename . "</br>
Nominated you for invigilator for the </br>
Examination Type: " . $result[0]['examprofile'] . " on</br>
Requested Examination Date: " . $edate . "</br>
Link to Invigilator login: https://ctcmaexam.ca/safety/index.php?/main/login</br></br>

Candidates must present a valid form of photo identification to the invigilator prior to being allowed to write an exam. This identification must be government issued (passport, drivers license, etc.)<br><br>
Electronic devices (i.e. iPods, cell phones, blackberries, etc.) are not allowed in the exam room.<br><br>
Candidates will have " . $result[0]['tottime'] / 60 . " minutes to complete the examination. He/she must complete the examination without the use of notes or hand-held computers; however, may access the Safety Program Handbook using the link provided on the examination site.<br><br>
Candidates are required to write the examination within 2 days of the requested write date. A multiple
examination fee applies if an examination is not written and is subsequently re-requested.<br><br>
Further details on the examination policies and guidelines are available in the Safety Examination Guide (http://www.ctcma.bc.ca/assets/files/pdf_resources/Safety/Safety_Program_Examination_Guide-rev1.pdf).<br><br>
This is an automated message, please do not reply. If you have any questions with this examination application, please contact the College at info@ctcma.bc.ca.";

        $to = $invig[0]['email'];
        $cc = "mark@veritagroup.com,adam@veritagroup.com";
        //echo $to;
        $this->mailhelper->sendmail($to, $cc, $subject, $message);
        $this->loggermodel->log($username, 'Invigilator ' . $iname . " approval email sent by " . $username);
        $this->viewexaminee($id);
    }

    function testforadmin() {
        if ($this->session->userdata('role') != 'admin') {
            $this->logout();
        }
    }

    function logout() {
        redirect('main/logout');
    }

}

?>

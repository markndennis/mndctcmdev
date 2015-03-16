<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invigilators extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('invigilatormodel');
        $this->load->model('examineemodel');
        $this->load->model('loggermodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
//$this->authorize();
    }

    function index() {
        $this->testforadmin();
    }

    function addinvigilator_OLD() {
        $this->testforadmin();
        $hdata['pagetitle'] = "Add Invigilator";

        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'User Name', 'required|is_unique[invigilators.username]');
        $this->form_validation->set_rules('contact', 'Published Contact Info', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('site/adminhmenu');
            $this->load->view('admin/invigilators/usermenu');
            $this->load->view('admin/invigilators/addinvigilator');
            $this->load->view('site/footer');
        } else {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $city = $this->input->post('city');
            $province = $this->input->post('province');
            $country = $this->input->post('country');
            $institution = $this->input->post('institution');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $contact = $this->input->post('contact');
            $this->invigilatormodel->addinvigilator($fname, $lname, $email, $city, $province, $country, $institution, $username, $contact, $password);
            $adminname = $this->session->userdata('name');
            $this->loggermodel->log($adminname, 'Invigilator ' . $fname . " " . $lname . " added by" . $adminname);
            redirect('admin/invigilators/listinvigilators');
        }
    }

    function addinvigilator() {
        $this->testforadmin();
        $hdata['pagetitle'] = "Add Invigilator";

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/invigilators/usermenu');
        $this->load->view('admin/invigilators/addinvigilator');
        $this->load->view('site/footer');
    }

	function invigmessage(){
		//echo "called";
		$hdata['pagetitle'] = "System Message";
		$message = $this->session->userdata('messagedata');
		//echo $message;
		$data['message'] = $message;
		
		$this->load->view('site/header', $hdata);
		$this->load->view('site/adminhmenu');
		$this->load->view('admin/invigilators/usermenu');
		$this->load->view('admin/invigilators/invigmessage',$data);
		$this->load->view('site/footer');
		
	}
	
	function testmessage(){
/* 		$message = "hello";
		$data['message'] = $message;
		$this->load->view('admin/invigilators/invigmessage',$data); */
		$this->invigmessage();
	}
	
	
	
    function postinvigilator() {
        $fname = $this->input->post('fname');
        $lname = $this->input->post('lname');
        $email = $this->input->post('email');
        $city = $this->input->post('city');
        $province = $this->input->post('province');
        $country = $this->input->post('country');
        $institution = $this->input->post('institution');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $contact = $this->input->post('contact');
 		$uniquename = $this->testuniqueinvigname($fname,$lname);
		
		if($uniquename == 'false'){
			$message='this invigilator name already exists, please use a unique invigilator name, the invigilator was not added';
			$this->session->set_userdata('messagedata', $message);
			redirect('admin/invigilators/invigmessage');
			//$this->invigmessage();
		}
		
		$uniqueusername = $this->testuniqueinvigusername($username);
		
		if($uniqueusername == 'false'){
			$message='invigilator username already exists, please use a a unique invigilator username, the invigilator was not added';
		    $this->session->set_userdata('messagedata', $message);
			//$this->invigmessage();
			redirect('admin/invigilators/invigmessage');
		} 
		
		$this->invigilatormodel->addinvigilator($fname, $lname, $email, $city, $province, $country, $institution, $username, $contact, $password);
		$adminname = $this->session->userdata('name');
		$this->loggermodel->log($adminname, 'Invigilator ' . $fname . " " . $lname . " added by" . $adminname);
        redirect('admin/invigilators/listinvigilators');
    }

    function viewinvigilator($id) {
        $this->testforadmin();
        $result = $this->invigilatormodel->getinvigilator($id);
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $hdata['pagetitle'] = "View Invigilator " . $name;
        $data['result'] = $result;
        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/invigilators/usermenu');
        $this->load->view('admin/invigilators/viewinvigilator', $data);
        $this->load->view('site/footer');
    }

    function editinvigilator($id) {
        $this->testforadmin();
        $result = $this->invigilatormodel->getinvigilator($id);
        $data['result'] = $result;
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $hdata['pagetitle'] = "View Invigilator " . $name;

        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact', 'Published Contact Info', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('site/adminhmenu');
            $this->load->view('admin/invigilators/usermenu');
            $this->load->view('admin/invigilators/editinvigilator', $data);
            $this->load->view('site/footer');
        } else {
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $email = $this->input->post('email');
            $city = $this->input->post('city');
            $province = $this->input->post('province');
            $country = $this->input->post('country');
            $institution = $this->input->post('institution');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $contact = $this->input->post('contact');
            $active = $this->input->post('active');
            $this->invigilatormodel->editinvigilator($id, $fname, $lname, $email, $city, $province, $country, $institution, $username, $password, $contact, $active);
            $username = $this->session->userdata('name');
            $this->loggermodel->log($username, 'Invigilator ' . $fname . " " . $lname . " edited by" . $username);
            redirect('admin/invigilators/viewinvigilator/' . $id);
        }
    }

    function deleteinvigilator($id) {
        $this->testforadmin();
        $examinees = $this->invigilatormodel->deleteinvigilator($id);
        $username = $this->session->userdata('name');
        $this->loggermodel->log($username, 'Invigilator ' . $id . " deleted by" . $username);
        redirect('admin/invigilators/listinvigilators');
    }

    function listinvigilators($message = null) {
        $this->testforadmin();

        $hdata['pagetitle'] = "List Invigilators";
		//echo $message;
		$data['message'] = $message;
        $data['listinvigilators'] = $this->invigilatormodel->listinvigilators();
//var_dump($data['listinvigilators']);
        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/invigilators/usermenu');
        $this->load->view('admin/invigilators/listinvigilators', $data);
        $this->load->view('site/footer');
    }

    function listexaminees($invigid) {
        $this->testforinvig();
        $this->examineemodel->updatestatus();
        $invig = $this->invigilatormodel->getinvigilator($invigid);
        $examinees = $this->invigilatormodel->examineeforinvig($invigid);
        $name = $invig[0]['fname'] . " " . $invig[0]['lname'];
        $hdata['pagetitle'] = $name . " Examinee List";
        $data['listexaminees'] = $examinees;
//var_dump($data['listexaminees']);
        $this->load->view('site/header', $hdata);
//$this->load->view('site/adminhmenu');
        $this->load->view('admin/invigilators/invigusermenu');
        $this->load->view('admin/invigilators/examineeforinvig', $data);
        $this->load->view('site/footer');
    }

    function invigapproval($id) {
        $this->testforinvig();
        $examinee = $this->examineemodel->getexaminee($id);
        $invigilator = $this->invigilatormodel->getinvigilator($this->session->userdata('id'));

        $hdata['pagetitle'] = "Exam Approval";
        $data['examinee'] = $examinee;
        $data['invigilator'] = $invigilator;

        //var_dump($data['listexaminees']);
        $this->load->view('site/header', $hdata);
        //$this->load->view('site/adminhmenu');
        $this->load->view('admin/invigilators/invigusermenu');
        $this->load->view('admin/invigilators/invigapproval', $data);
        $this->load->view('site/footer');
    }

    function sendinvigwelcomeemail($invigid) {
        $result = $this->invigilatormodel->getinvigilator($invigid);
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $username = $this->session->userdata('name');
        $subject = "Welcome CTCMA (BC) Safety Exam Invigilator";
        $message = $name . ", you have been approved by the College of Traditional Chinese Medicine Practitioners and Acupuncturists of BC (CTCMA BC) as a Safety Exam invigilator. Your login details are contained below:<br><br><strong>Username:</strong> " . $result[0]['username'] . "<br><strong>Password:</strong> " . $result[0]['password'] . "<br><br>When you login you will be able to select your approved examinee candidates.<br><br>Should you have any questions please contact: info@ctcma.bc.ca";

        $to = $result[0]['email'];
        $cc = '';
        $this->mailhelper->sendmail($to, $cc, $subject, $message);
        $this->loggermodel->log($username, 'Invigilator ' . $name . " welcome email sent by " . $username);
        $this->viewinvigilator($invigid);
    }

    function sendinvigpasswordemail($invigid) {
        $result = $this->invigilatormodel->getinvigilator($invigid);
        $name = $result[0]['fname'] . " " . $result[0]['lname'];
        $username = $this->session->userdata('name');
        $subject = "CTCMABC Invigilator Password Change";
        $message = $name . " . your CTCMABC login details have been changed.  Please see below for your new login details:<br><br><strong>Username:</strong> " . $result[0]['username'] . "<br><strong>Password:</strong> " . $result[0]['password'] . "<br><br>When you login you will be able to select your approved examinee candidates.<br><br>Should you have any questions please contact: info@ctcma.bc.ca";
        $to = $result[0]['email'];
        $cc = '';
        $this->mailhelper->sendmail($to, $cc, $subject, $message);
        $this->loggermodel->log($username, 'Invigilator ' . $name . " password update email sent by " . $username);
        $this->viewinvigilator($invigid);
    }
	
	function testuniqueinvigname($fname,$lname){	
		
		$result = $this->invigilatormodel->listinvigilators();
		$returnval='true';
		
		foreach($result as $row){
			
			if ($row['fname'] == $fname && $row['lname'] == $lname) {
				$returnval='false';
				//echo $returnval;
			}	
		}
		
		return $returnval;
	}
	
	function testuniqueinvigusername($username){
		
		$result = $this->invigilatormodel->listinvigilators();
		$returnval='true';
		
		foreach($result as $row){
			
			if ($row['username'] == $username){
				$returnval='false';
				//echo $returnval;
			}
		}
		
		return $returnval;
	}
	

    function testforadmin() {
        if ($this->session->userdata('role') != 'admin') {
            redirect('main/logout');
        }
    }

    function testforinvig() {
        if ($this->session->userdata('role') != 'invig') {
            redirect('main/logout');
        }
    }

}

?>

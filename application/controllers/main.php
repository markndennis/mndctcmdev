<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->library('form_validation');
        $this->load->model('examineemodel');
        $this->load->model('exammodel');
        $this->load->model('invigilatormodel');
        $this->load->model('loggermodel');
    }

    function index() {
        redirect('main/welcome');
    }

    function welcome() {
        $hdata['pagetitle'] = "Welcome";

        $this->load->view('site/header', $hdata);
        $this->load->view('main/mainmenu');
        $this->load->view('main/welcomeview');
        $this->load->view('site/footer');
    }

    function about() {
        $hdata['pagetitle'] = "About";

        $this->load->view('site/header', $hdata);
        $this->load->view('main/mainmenu');
        $this->load->view('main/about');
        $this->load->view('site/footer');
    }

    function application() {
        $hdata['pagetitle'] = "Apply to Take Exam";

        $data['invigs'] = $this->invigilatormodel->listapprovedinvigilators();

        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
		//$this->form_validation->set_rules('regnum', 'Registration', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('dob','Date of Birth','required');
        $this->form_validation->set_rules('examdate','Exam Date','required');
        //$this->form_validation->set_rules('exam', 'Exam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('main/mainmenu');
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
//            echo $invigid;
//            sleep (30);
            $id = $this->examineemodel->addexaminee($fname, $lname, $dob, $examdate, $regnum, $email, $exam, $invigid);
            //$id = $this->examineemodel->getexamineeid($regnum);
            //echo $id;
            $this->applicationsuccess($id);
        }
    }

    function applicationsuccess($id) {
        $hdata['pagetitle'] = "Application Success";
        $examinee = $this->examineemodel->getexaminee($id);
//        echo var_dump($examinee);
//        echo $examinee[0]['invigilatorID'];
        $invig = $this->invigilatormodel->getinvigilator($examinee[0]['invigilatorID']);
//        echo var_dump($invig);
        $data['examinee'] = $examinee;
        $data['invig'] = $invig;
        $this->load->view('site/header', $hdata);
        $this->load->view('main/mainmenu');
        $this->load->view('main/applicationsuccess',$data);
        $this->load->view('site/footer');
    }

    function invigilators() {
        $hdata['pagetitle'] = "Approved Invigilators";
        $data['listinvigilators'] = $this->invigilatormodel->listapprovedinvigilators();
        //echo var_dump($data['invig']);
        $this->load->view('site/header', $hdata);
        $this->load->view('main/mainmenu');
        $this->load->view('main/approvedinvigilators', $data);
        $this->load->view('site/footer');
    }

    function invigilatordetail($id) {
        $hdata['pagetitle'] = "Invigilator Information";
        $data['invig'] = $this->invigilatormodel->getinvigilator($id);
        //echo var_dump($data['invig']);
        $this->load->view('site/header', $hdata);
        $this->load->view('main/mainmenu');
        $this->load->view('main/invigilatordetail', $data);
        $this->load->view('site/footer');
    }

    function login() {
        $admin1uname = "ctcmaadmin";
        $admin1pswd = "ctcma3108";
        $admin2uname = "vsgadmin";
        $admin2pswd = "sarasota1";

        $hdata['pagetitle'] = "Login";

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_message('required', 'valid login credentials required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('main/mainmenu');
            $this->load->view('main/login');
            $this->load->view('site/footer');
        } else {
            $this->load->view('site/header', $hdata);
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            //test for admin
            if (($username === $admin1uname && $password === $admin1pswd) || ($username === $admin2uname && $password === $admin2pswd)) {
                //echo $this->session->userdata('session_id');
                $this->session->set_userdata('role', 'admin');
                $this->session->set_userdata('name', $username);
                $message = 'Administrator ' . ' ' . $username . ' signed in';
                $this->loggermodel->log($username, $message);
                $message = $this->agent->agent_string();
                $this->loggermodel->log($username, $message);
                redirect('admin/examinees/listexaminees');
            } else { // if not admin must be invigilator
                $invig = $this->invigilatormodel->validateinvigilator($username, $password);
                if ($invig != FALSE) {
                    $this->session->set_userdata('role', 'invig');
                    $this->session->set_userdata('name', $username);
                    $this->session->set_userdata('id', $invig[0]['id']);
                    $message = 'Invigilator ' . $username . ' ' . ' signed in';
                    $this->loggermodel->log($username, $message);
                    $message = $this->agent->agent_string();
                    $this->loggermodel->log($username, $message);
                    if ($password === 'invig01') {
                        redirect('passwords/createpassword/' . $invig[0]['id']);
                    } else {
                        //echo var_dump($invig);
                        redirect('admin/invigilators/listexaminees/' . $invig[0]['id']);
                    }
                }
            }

            redirect('main/login');
        }
    }

    function logout() {
        $username = $this->session->userdata('name');
        $message = ($username . ' logged out');
        $this->loggermodel->log($username, $message);
        $this->session->sess_destroy();
        redirect('main/login', 'refresh');
    }

}

?>

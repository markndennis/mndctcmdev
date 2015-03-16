<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Passwords extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('passwordmodel');
        $this->load->model('invigilatormodel');
        $this->load->model('loggermodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
    }

    function index() {
        echo "hello from passwords";
    }

    function createpassword($id) {
        $hdata['pagetitle'] = "Create Password";
        $data['invigilator'] = $this->invigilatormodel->getinvigilator($id); 
        $username=$data['invigilator'][0]['username'];

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|max_length[12]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('passwords/usermenu');
            $this->load->view('passwords/createpassword',$data);
            $this->load->view('site/footer');
        } else {
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
            //echo $data['invigilator'][0]['username'];
            $user = $this->passwordmodel->validateuser($username);
            if ($user && $password1 === $password2) {
                $this->passwordmodel->updatepassword($username, $password1);
                $this->load->view('site/header', $hdata);
                $this->load->view('passwords/usermenu');
                $this->load->view('passwords/success');
                $this->load->view('site/footer');
                $this->loggermodel->log($username,'Invigilator '.$username . 'changed their password');
            }
            else
                redirect('passwords/createpassword/'.$id);
        }
    }

    function changepassword() {
        $hdata['pagetitle'] = "Change Password";


        $this->form_validation->set_rules('username', 'User Name', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[5]|max_length[12]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('site/header', $hdata);
            $this->load->view('passwords/usermenu');
            $this->load->view('passwords/changepassword');
            $this->load->view('site/footer');
        } else {
            $username = $this->input->post('username');
            $password1 = $this->input->post('username');
            $password1 = $this->input->post('username');
            $user = $this->passwordmodel->validateuser($username);
            if ($user && $password1 === $password2) {
                $this->passwordmodel->updatepassword($username, $password1);
                $this->load->view('site/header', $hdata);
                $this->load->view('passwords/usermenu');
                $this->load->view('passwords/success');
                $this->load->view('site/footer');
            }
            else
                redirect('passwords/changepassword');
        }
    }

    function forgotpassword($id) {
        
    }

}

?>

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logger extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('loggermodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');

//$this->authorize();
    }

    function index() {
        $this->testforadmin();
    }

    function log($username, $message) {
        $this->loggermodel->log($username, $message);
    }

    function listlog() {
        $this->testforadmin();
        $hdata['pagetitle'] = "List Log";

        $data['log'] = $this->loggermodel->getlog();

        $this->load->view('site/header', $hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/logs/usermenu');
        $this->load->view('admin/logs/showlog', $data);
        $this->load->view('site/footer');
    }

    function savelog() {
        $this->testforadmin();
        $hdata['pagetitle'] = "Log Archive Confirm";

        $this->load->view('site/header', $hdata);
        $this->load->view('admin/logs/confirmation');
        $this->load->view('site/footer');
        
    }

    function loggit() {
        $this->loggermodel->log2csv();
        $username = $this->session->userdata('name');
        $this->loggermodel->log($username, 'log saved and emailed');
        redirect('admin/listlog');
    }

    function testforadmin() {
        if ($this->session->userdata('role') != 'admin') {
            redirect('main/logout');
        }
    }

}
?>
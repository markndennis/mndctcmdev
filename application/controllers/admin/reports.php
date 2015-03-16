<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('examineemodel');
        $this->load->model('exammodel');
         $this->load->model('resultmodel');
        $this->load->helper('string');
        $this->load->helper('url');
        $this->load->library('session');
    }

    function index() {
        $hdata['pagetitle'] = "Reports";
        $this->load->view('site/header',$hdata);
        $this->load->view('site/adminhmenu');
        $this->load->view('admin/reports/usermenu');
        $this->load->view('admin/reports/reports');
        $this->load->view('site/footer');
        //$this->load->library('session');
    }
   
    function quesresults() {
        $questions = $this->exammodel->getallques();
        $results = $this->resultmodel->getallresults();
        
        foreach($questions as $row){
            
        }
    }

}

?>

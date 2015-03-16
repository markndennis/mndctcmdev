<?php

class Passwordmodel extends CI_Model {

    function __construct() {

//        // Call the Model constructor
        parent::__construct();
        
        $this->load->model('mailhelper');
        $this->load->library('email');
    }

    function temppassword() {
        $rstring = random_string('alnum', 8);
        //echo $rstring;
        return $rstring;
    }

    function updatepassword($username, $password) {
        $data = array('password' => $password);
        $this->db->where('username',$username);
        $this->db->update('invigilators', $data);
    }

    
     function validateuser($username) {
        $this->db->from('invigilators');
        $this->db->where('username', $username);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }
}

?>

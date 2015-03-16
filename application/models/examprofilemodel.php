<?php

class Examprofilemodel extends CI_Model {

    function __construct() {

        // Call the Model constructor
        parent::__construct();
    }

    function retrieveall() {
        $this->db->from('examprofile');
        //$this->db->where('pin', $pin);
        $query = $this->db->get();
        return $query->result_array();
    }

    function retrieveprofile($profile) {
        $this->db->from('examprofile');
        $this->db->where('profilename', $profile);
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>

<?php

class Invigilatormodel extends CI_Model {

    function __construct() {

//        // Call the Model constructor
        parent::__construct();
//        $this->load->database();
//        $this->load->dbutil();
//        $this->load->helper('file');
//        $this->load->model('mailer');
//        //$this->load->library('email');
        // $this->load->helper('string');
    }

    function addinvigilator($fname, $lname, $email ,$city, $province, $country, $institution, $username, $contact, $password) {

        $datetime = date('Y-m-d H:i:s', time());
        
        $data = array(
            'fname' => trim($fname),
            'lname' => trim($lname),
            'email' => trim($email),
            'city' => trim($city),
            'province' => trim($province),
            'country' => trim($country),
            'institution' => trim($institution),
            'username' => trim($username),
            'contactinfo' => trim($contact),
            'password' => $password,
            'active' => 'Y',
            'created' => $datetime
        );

        $this->db->insert('invigilators', $data);
    }

    function editinvigilator($id, $fname, $lname, $email, $city, $province, $country, $institution,$username, $password, $contact, $active) {

        $data = array(
            'fname' => trim($fname),
            'lname' => trim($lname),
            'email' => trim($email),
            'city' => trim($city),
            'province' => trim($province),
            'country' => trim($country),
            'institution' => trim($institution),
            'username' => trim($username),
            'contactinfo' => trim($contact),
            'password' => trim($password),
            'active' => trim($active)
            
        );
        $this->db->where('id', $id);
        $this->db->update('invigilators', $data);
    }
    
      function getinvigilator($id){
        $this->db->from('invigilators');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    function examineeforinvig($id){
          $this->db->from('examinees');
          $this->db->where('invigilatorID',$id);
          $this->db->where('astatus',"Approved");
          $this->db->where('estatus',"Eligible Not Started");
          $this->db->or_where('estatus','Eligible Incomplete');
          $this->db->where('finishtime','0000-00-00 00:00:00');
          $query = $this->db->get();
          return $query->result_array();
    }
    

    function validateinvigilator($username, $password) {
        //echo "hello from validate";
        //$this->db->select('id, username, password');
        
        $this->db->from('invigilators');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();      
        } else {
            return false;
        }
    }

    function listinvigilators() {
		//$this->db->where('active', 'Y');
        $this->db->order_by("institution");
        $this->db->order_by("lname");
        $this->db->order_by("id");
		
        $query=$this->db->get('invigilators');
        return $query->result_array();
    }
    
     function listapprovedinvigilators() {
        $this->db->order_by("country");
        $this->db->order_by("city");
        $this->db->order_by("institution");
        $this->db->order_by("lname");
        $this->db->where("active","Y");
        $query=$this->db->get('invigilators');
        return $query->result_array();
    }
    
    function listinvigilatorssrt($sfield) {
         if ($this->session->userdata('toggle') === 1) {
            $so = 'asc';
            $this->session->set_userdata('toggle', 0);
        } else {
            $so = 'desc';
            $this->session->set_userdata('toggle', 1);
        }
        $this->db->order_by($sfield . " " . $so);
        $this->db->from('invigilators');
        $query=$this->db->get();
        return $query->result_array();
    }
    

    function deleteinvigilator($id){
        $this->db->where('id', $id);
        $this->db->delete('invigilators');
    } 
    
}

?>

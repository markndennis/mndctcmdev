<?php

class Examineemodel extends CI_Model {

    function __construct() {

        parent::__construct();

        $this->load->model('testingmodel');
        $this->load->model('examprofilemodel');
    }

    function addexaminee($fname, $lname, $dob, $examdate, $regnum, $email, $exam, $invigid) {

        $datetime = date('Y-m-d H:i:s', time());

        //echo $exam;
        $time = $this->exammodel->getexamtime($exam);
        $time=$time*60;
        //echo $time;

        $data = array(
            'fname' => trim($fname),
            'lname' => trim($lname),
            'dob' => trim($dob),
            'examdate'=> trim($examdate),
            'regnum' => trim($regnum),
            'email' => trim($email),
            'pin' => uniqid(''),
            'examprofile' => $exam,
            'astatus' => 'Not Approved',
            'invigilatorID' => $invigid,
            'tottime' => $time,
            'created' => $datetime
        );

        // return the id for the record just added
        $this->db->insert('examinees', $data);
        $this->db->from('examinees');
        $this->db->where('created', $datetime);
        $query = $this->db->get();
        $examinee = $query->result_array();
        //echo var_dump($examinee);
        return $examinee[0]['id'];
        
    }

    function editexaminee($id, $fname, $lname, $dob, $examdate, $regnum, $email, $astatus, $invigid) {

        $data = array(
            'fname' => trim($fname),
            'lname' => trim($lname),
            'dob' => trim($dob),
            'examdate' => trim($examdate),
            'regnum' => trim($regnum),
            'email' => trim($email),
            'astatus' => trim($astatus),
            'invigilatorID' => $invigid,
        );
        //echo var_dump($data);
        //echo $pin;
        $this->db->where('id', $id);
        $this->db->update('examinees', $data);
    }

    function deleteexaminee($id) {
        $this->db->where('id', $id);
        $this->db->delete('examinees');
    }
    
    function postestatus($id,$status){
        $this->db->where('id',$id);
        $data = array(
            'estatus' => $status
        );
        $this->db->update('examinees',$data);
    }

    function posttime($id) {
        // calculate elapsed time
        $result=$this->getexaminee($id);
        $starttime =  strtotime($result[0]['starttime']);
        //echo $starttime;
        $elapsedtime = (time()-$starttime);
        $this->db->where('id', $id);
        $data = array(
            'elapsedtime' => trim($elapsedtime),
        );
        $this->db->update('examinees', $data);
        $result=$this->getexaminee($id);
        $remaintime = $result[0]['tottime'] - $elapsedtime;
        if ($remaintime <= 0){
            redirect('/exam/myexam/postfinishtime/'.$id);
        }
        //echo $remaintime;
        return $remaintime;
    }

    function getstarttime($id) {
        $this->db->from('examinees');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['starttime'];
    }

    function poststarttime($id) {
        //$datetime = date('Y-m-d H:i:s', time());
        $result=$this->getexaminee($id);
        $elapsedtime = $result[0]['elapsedtime'];
        $adjtime = time()-$elapsedtime;
        $datetime = date('Y-m-d H:i:s', $adjtime);
        //echo $datetime;
        $this->db->where('id', $id);
        $data = array(
            'starttime' => $datetime,
        );
        $this->db->update('examinees', $data);
    }
    
    function postfinishtime($id){
        $datetime = date('Y-m-d H:i:s', time());
        
        $this->db->where('id', $id);
        $data = array(
            'finishtime' => $datetime,
        );
        $this->db->update('examinees', $data);
    }

    function getexaminee($id) {
        $this->db->from('examinees');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getexamineeid($regnum)
    {
        $this->db->from('examinees');
        $this->db->where('regnum', $regnum);
        $query = $this->db->get();
        $examinee = $query->result_array();
        //echo var_dump($examinee);
        return $examinee[0]['id'];
    }

    function validatepin($pin) {
        //echo "hello from validate";
        //$this->db->select('id, username, password');
        $this->db->from('examinees');
        $this->db->where('pin', $pin);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function listexaminees() {
        // provides an array of examinees not sorted
        $this->db->from('examinees');
        $query = $this->db->get();
        return $query->result_array();
    }

    function questionseq($profile) {
        // creates a delimited string of random question numbers
        $profileinfo = $this->examprofilemodel->retrieveprofile($profile);
        //echo var_dump($profileinfo); 


        $seq = array();
        for ($x = 1; $x < 121; $x++) {
            $seq[] = $x;
        }
        shuffle($seq);
        $seq = array_slice($seq, 0, 60);
        //echo "count is: " . count($seq) . "<br/>";
        $qseq = implode(',', $seq);
        return $qseq;
    }
    
    function updatestatus() {
        $examinees = $this->examineemodel->listexaminees();
        foreach ($examinees as $row) {
            $starttime = $row['starttime'];
            $finishtime = $row['finishtime'];
            //echo  (strtotime($row['examdate'])-date(time()))/60/60/24;
            $days = (strtotime($row['examdate']) - date(time())) / 60 / 60 / 24;

            if ($finishtime != '0000-00-00 00:00:00') {
                $this->examineemodel->postestatus($row['id'], 'Completed');
            } elseif ($days > 3) {
                //echo "Not Eligible<br>";
                $this->examineemodel->postestatus($row['id'], 'Not Yet Eligible');
            } elseif ($days < 4 && $days > -4 && $starttime == '0000-00-00 00:00:00' && $finishtime == '0000-00-00 00:00:00') {
                //echo "Not Started<br>";
                $this->examineemodel->postestatus($row['id'], 'Eligible Not Started');
            } elseif ($days < 4 && $days > -4 && $starttime != '0000-00-00 00:00:00' && $finishtime == '0000-00-00 00:00:00') {
                $this->examineemodel->postestatus($row['id'], 'Eligible Incomplete');
            } elseif ($days < -4) {
                //echo "Expired<br>";
                $this->examineemodel->postestatus($row['id'], 'Expired');
            } else {
                //echo "other<br>";
                $this->examineemodel->postestatus($row['id'], 'Other');
            }
        }
    }
    
    function postcomments($id,$comments){
        $data = array(
            'comments' => trim($comments),
        );
        $this->db->where('id', $id);
        $this->db->update('examinees', $data);
    }

}

?>

<?php

class Resultmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function initializeanswers($id, $qseq) {
        // creates NA answers for all questions
        $this->db->where('examineeid', $id);
        $this->db->delete('results');
        
        $qidarray = explode(",", $qseq);
        //echo var_dump($qidarray);
        foreach ($qidarray as $row) {
            $this->postanswer($id, $row, 'NA');
        }
    }

    function updateanswers($id, $answerarray) {
        foreach ($answerarray as $row) {
            $this->updateanswer($id, $row['id'], $row['answer']);
        }
    }

    function postanswer($id, $qid, $answer) {

        $datetime = date('Y-m-d H:i:s', time());

        $data = array(
            'examineeid' => $id,
            'qid' => $qid,
            'answer' => $answer,
            'created' => $datetime
        );

        $this->db->insert('results', $data);
    }

    function updateanswer($id, $qid, $answer) {

        $datetime = date('Y-m-d H:i:s', time());

        $data = array(
            'answer' => $answer,
            'created' => $datetime
        );
        
        $this->db->where('examineeid',$id);
        $this->db->where('qid',$qid);
        $this->db->update('results', $data);
    }

    function getanswer($id, $qid) {
        $this->db->where('id', $id);
        $this->db->where('qid', $qid);
        $answer = $this->db->get('results');
        return $answer->result_array();
    }
    
    function answerarray($id){
        $this->db->where('examineeid', $id);
        $answerarray=$this->db->get('results');
        //echo var_dump($answerarray->result_array());
        return $answerarray->result_array();
    }
    
    function getallresults(){
        $results=$this->db->get('results');
        return $results->result_array();
    }

}

?>

<?php

class Loggermodel extends CI_Model {

    function __construct() {

//        // Call the Model constructor
        parent::__construct();
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->model('mailhelper');
        $this->load->library('email');
    }

    function log($user, $message) {
        $datetime = date('Y-m-d H:i:s', time());
        $data = array(
            'user' => $user,
            'message' => $message,
            'date' => $datetime
        );
        $this->db->insert('log', $data);
    }

    function getlog() {

        $this->db->from('log'); // run that query
        $query = $this->db->get();

        $data = $query->result_array();

        return $data;
    }

    function log2csv() {
        //echo 'log2csv called';
        //$this->db->select('Event_Id,Pin,Message,Date'); //select columns
        //$this->db->order_by("Date", "desc"); //newest entry on top

        $query = $this->db->get('log');
        //echo var_dump($query->result_array());

        //$data = $query->result_array();
        $delimiter = ",";
        $newline = "\r\n";

        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        $datetime = date('Ymd', time());
        $filename = 'log' . $datetime;
        if (!write_file('./assets/files/' . $filename . '.csv', $data, 'wb')) {
            $this->loggermodel->log('Administrator', 'Unable to save log file');
        } else {
            $this->db->empty_table('log');
            $this->log('Administrator', 'Log File Saved');
            $this->log('Administrator', 'Log File Emptied');
            $this->emaillog('./assets/files/' . $filename . '.csv');
        }

        //return $data;
    }

    function emaillog($attachment) {
        $to = 'marknden@gmail.com';
        $subject = 'CTCMABC Archived Log File';
        $message = 'This is an automatically generated e-mail notification.Please find attached a copy of the recently archived log file.<br><br>';

        $this->mailhelper->sendmail($to,"", $subject, $message, $attachment);
        $logmess = "log file saved and sent";
        $this->loggermodel->log($to, $logmess);
        redirect('admin/logger/listlog');
    }

}

/* End of file logger.php */
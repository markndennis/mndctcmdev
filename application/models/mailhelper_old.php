<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailhelper extends CI_Model {

    function sendmail($to,$subject,$message) {
        $config['mailpath'] = "/usr/sbin/sendmail";
        //$config['protocol'] = "sendmail";
        $config['smtp_host'] = "smtpout.secureserver.net";
        $config['smtp_user'] = "admin@gbrba.com";  //this address must not be a public email service provider like yahoo, gmail, hotmail... etc
        $config['smtp_pass'] = "safety01";
        $config['smtp_port'] = "465";
        //$config['mailtype'] = "html";
        $config['validate'] = "TRUE";
     

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->set_protocol('sendmail');
        $this->email->set_mailtype('html');

        $this->email->from('admin@markndennis.com');
        $this->email->to($to);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->email->subject($subject);
        $this->email->message($message);
//        if($attachment != NULL){
//        $this->email->attach($attachment);
//        }

        $this->email->send();
        $logmess = $this->email->print_debugger();
        echo $logmess;
        //$this->logger->add2log($to, $logmess);
        //echo $this->email->print_debugger();
    }
}

/* End of file mailhelper.php */

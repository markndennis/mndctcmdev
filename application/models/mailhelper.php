<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailhelper extends CI_Model {

    function sendmail($to, $cc, $subject, $message, $attachment = '') {
         $this->load->library('email');

        // Email account and to information
        $ACCOUNT = 'admin@markndennis.com';
        $PASSWORD = 'public01';
        //$EMAILTO = 'marknden@gmail.com';
        

        // Email configuraion
        $config['protocol'] = "sendmail";
        $config['mailpath'] = "/usr/sbin/sendmail";
        $config['smtp_host'] = "smtpout.secureserver.net";
        $config['smtp_user'] = "admin@gbrba.com";
        $config['smtp_pass'] = "safety01";
        $config['smtp_port'] = "465";
        $config['mailtype'] = "html";
        //$config['wordwrap'] = "TRUE";
        $config['newline'] = ("\r\n");
        $config['crlf'] = ("\r\n");
        $config['validate'] = "TRUE";
        
        $this->email->initialize($config);
        //$this->email->set_newline("\r\n");
        //$this->email->set_crlf("\r\n");

        $this->email->from('admin@markndennis.com');
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($attachment != '') {
            $this->email->attach($attachment);
        }

        $this->email->send();
        //$logmess = $this->email->print_debugger();
        //echo $logmess;
        
        //echo $this->email->print_debugger();
    }

}

/* End of file mailhelper.php */

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mailservice {

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('Email_config_model');
        $this->CI->load->library('email');
    }

    public function send($cuenta, $to, $subject, $message)
    {
        $cfg = $this->CI->Email_config_model->get_config($cuenta);

        if (!$cfg) {
            return "No existe la cuenta SMTP: $cuenta";
        }

        $config = [
            'protocol'     => 'smtp',
            'smtp_host'    => $cfg['smtp_host'],
            'smtp_user'    => $cfg['smtp_user'],
            'smtp_pass'    => $cfg['smtp_pass'],
            'smtp_port'    => $cfg['smtp_port'],
            'smtp_crypto'  => $cfg['smtp_crypto'],
            'mailtype'     => $cfg['mailtype'],
            'charset'      => $cfg['charset'],
            'newline'      => "\r\n",
            'crlf'         => "\r\n"
        ];

        $this->CI->email->initialize($config);

        $this->CI->email->from($cfg['smtp_user']);
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        return $this->CI->email->send()
            ? true
            : $this->CI->email->print_debugger();
    }
}

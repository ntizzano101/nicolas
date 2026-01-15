<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_cuentas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_config_model');
        $this->load->model('Empresas_model');
    }

public function index() {
     $data['cuentas'] = $this->Email_config_model->all_with_empresa(); 
            $this->load->view('encabezado.php');
        $this->load->view('menu.php');
     $this->load->view('email_cuentas/index', $data); }

    public function crear()
    {
        if ($this->input->post()) {
            $this->Email_config_model->insert($this->input->post());
            redirect('email_cuentas');
        }

        $data['empresas'] = $this->Empresas_model->all();
               $this->load->view('encabezado.php');
        $this->load->view('menu.php');
        $this->load->view('email_cuentas/form', $data);
    }

    public function editar($id)
    {
        if ($this->input->post()) {
            $this->Email_config_model->update($id, $this->input->post());
            redirect('email_cuentas');
        }

        $data['cuenta'] = $this->Email_config_model->get($id);
        $data['empresas'] = $this->Empresas_model->all();
               $this->load->view('encabezado.php');
        $this->load->view('menu.php');

        $this->load->view('email_cuentas/form', $data);
    }
    public function eliminar($id)
    {
        $this->Email_config_model->delete($id);
        redirect('email_cuentas');
    }



}

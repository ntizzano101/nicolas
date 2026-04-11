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

public function probar($id)
    {
        $cuenta = $this->Email_config_model->get($id);
        $this->load->library('email');
        if (!$cuenta) {
            show_error("Cuenta no encontrada");
        }

        // Configuración SMTP desde la BD
        $config = [
            'protocol'    => 'smtp',
            'smtp_host'   => $cuenta->smtp_host,
            'smtp_user'   => $cuenta->smtp_user,
            'smtp_pass'   => $cuenta->smtp_pass,
            'smtp_port'   => $cuenta->smtp_port,            
            'mailtype'    => $cuenta->mailtype,
            'charset'     => $cuenta->charset,
            'smtp_crypto' => strtolower($cuenta->smtp_crypto) === 'ssl' ? 'ssl' : 'tls',
            'smtp_timeout' => 10,
            'smtp_keepalive' => TRUE,
            'newline'     => "\r\n",
            'crlf'        => "\r\n"
        ];

        $this->email->initialize($config);

        // Email de prueba
        $this->email->from($cuenta->smtp_user, 'Prueba SMTP');
        $this->email->to($cuenta->smtp_user);
        $this->email->subject('Prueba de configuración SMTP');
        $this->email->message('Este es un correo de prueba enviado desde CodeIgniter 3.');

        if ($this->email->send()) {
            $resultado = "<div style='color:green;font-size:18px'>✔️ Correo enviado correctamente.</div>";
        } else {
            $resultado = "<div style='color:red;font-size:18px'>❌ Error al enviar:</div><pre>" . $this->email->print_debugger() . "</pre>";
        }

        echo "<h2>Resultado de la prueba</h2>";
        echo $resultado;
        echo "<br><br><a href='" . base_url('email_cuentas/editar/'.$id) . "'>Volver</a>";
    }

}

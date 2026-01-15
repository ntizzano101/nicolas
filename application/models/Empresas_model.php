<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Empresas_model extends CI_Model {

    public function all()
    {
        return $this->db->order_by('razon_soc')->get('empresas')->result();
    }
	
	public function all_with_empresa() 
	{ return $this->db ->select('email_cuentas.*, empresas.razon_soc') ->from('email_cuentas') ->join('empresas', 'empresas.id = email_cuentas.id_empresa') ->order_by('empresas.razon_soc') ->get() ->result(); }
}

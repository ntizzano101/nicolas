<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Email_config_model extends CI_Model {

  public function all_with_empresa() 
        { return $this->db ->select('email_cuentas.*, 
        empresas.razon_soc') ->from('email_cuentas') ->join('empresas', 'empresas.id_empresa = email_cuentas.id_empresa') ->order_by('empresas.razon_soc') ->get() ->result(); 
        }
  
  public function get($id)
    {
        return $this->db->where('id', $id)->get('email_cuentas')->row();
    }

    public function insert($data)
    {
        return $this->db->insert('email_cuentas', $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update('email_cuentas', $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete('email_cuentas');
    }

    public function get_by_nombre($nombre, $id_empresa)
    {
        return $this->db
            ->where('nombre', $nombre)
            ->where('id_empresa', $id_empresa)
            ->where('activo', 1)
            ->get('email_cuentas')
            ->row_array();
    }
}

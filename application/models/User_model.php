<?php
class User_model extends CI_Model
{
    public function save($name, $email, $password, $permission = '0')
    {
        return $this->db->insert('usuario', array(
            'nome' => $name,
            'email' => $email,
            'senha' => $password,
            'permissao' => $permission
        ));
    }
    public function userValidate($email)
    {
        return $this->db->get_where('usuario', array('email' => $email))->row_array();
    }
}

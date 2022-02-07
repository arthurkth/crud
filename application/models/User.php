<?php
class User extends CI_Model
{
    public function save($nome, $email, $senha, $permissao = '0')
    {
        return $this->db->insert('usuario', array(
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha,
            'permissao' => $permissao
        ));
    }
    public function userValidate($email)
    {
        return $this->db->get_where('usuario', array('email' => $email))->row_array();
    }
}

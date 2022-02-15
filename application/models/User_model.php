<?php
class user_model extends My_Model
{
    protected $table = 'usuario';

    public function userValidate($email)
    {
        return $this->db->get_where('usuario', [
            'email' => $email
        ])->row();
    }
}

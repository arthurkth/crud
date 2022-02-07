<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
    public function register()
    {
        $this->load->template('admin/cadastro-admin');
    }
    public function login()
    {
        $this->load->model('User_model');
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $user = $this->User_model->userValidate($email);
        $userPass = $this->encrypt->decode($user['senha']);
        if ($password === $userPass && $password !== '' && $user !== '') {
            $this->session->set_userdata('usuario_logado', $user);
            redirect('/');
        } else {
            $this->session->unset_userdata($user);
            $this->session->set_flashdata("danger", "Usuário ou senha inválidos!");
            redirect('/');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('usuario_logado');
        $this->session->sess_destroy();
        redirect('/');
    }
    public function formuser()
    {
        $this->load->library('encrypt');
        $this->load->model('User_model');
        $name = $_POST['nome'];
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $user = $this->User_model->userValidate($email);
        if ($user == false) {
            if ($name !== '' && $email !== '' && $password !== '') {
                if ($permission = $_POST['permissao']) {
                    $permission = $_POST['permissao'];
                } else {
                    $permission = '';
                }
                $encrypted_pass = $this->encrypt->encode($password);
                $this->User_model->save($name, $email, $encrypted_pass, $permission);
                $this->session->set_flashdata("success", "Cadastrado com sucesso");
                redirect('/');
            }
        }

        $this->session->set_flashdata("danger", "Preencha todos os campos corretamente!");
        redirect('/');
    }
}

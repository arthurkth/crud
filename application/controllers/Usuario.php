<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    public function registro()
    {
        $this->load->template('admin/cadastro-admin');
    }
    public function login()
    {
        $this->load->model('User');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $user = $this->User->userValidate($email);
        $userPass = $this->encrypt->decode($user['senha']);
        if ($senha === $userPass && $senha !== '' && $user !== '') {
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
    public function cadastrar()
    {
        $this->load->library('encrypt');
        $this->load->model('User');
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $user = $this->User->userValidate($email);
        if ($user == false) {
            if ($nome !== '' && $email !== '' && $senha !== '') {
                if ($permissao = $_POST['permissao']) {
                    $permissao = $_POST['permissao'];
                } else {
                    $permissao = '';
                }
                $encrypted_pass = $this->encrypt->encode($senha);
                $this->User->save($nome, $email, $encrypted_pass, $permissao);
                $this->session->set_flashdata("success", "Cadastrado com sucesso");
                redirect('/');
            }
        }

        $this->session->set_flashdata("danger", "Preencha todos os campos corretamente!");
        redirect('/');
    }
}

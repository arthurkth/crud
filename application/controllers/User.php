<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->library('encrypt');
    }

    public function register()
    {
        $this->load->template('admin/cadastro-admin');
    }


    public function login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('senha', true);

        if (!$email || !$password) {
            $this->session->set_flashdata('danger', 'Preencha corretamente usuário e senha');
            redirect('/');
        }

        $user = $this->user_model->userValidate($email);
        $userPass = $this->encrypt->decode($user->senha);


        if ($password === $userPass) {
            $this->session->set_userdata('usuario_logado', $user);
            redirect('/');
        }

        $this->session->set_flashdata("danger", "Usuário ou senha inválidos!");
        redirect('/');
    }

    public function logout()
    {
        $this->session->unset_userdata('usuario_logado');
        $this->session->sess_destroy();
        redirect('/');
    }

    public function userRegister()
    {
        $name = $this->input->post('nome', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('senha', true);

        $this->userValidate([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        $this->user_model->save([
            'nome' => $name,
            'email' => $email,
            'senha' => $this->encrypt->encode($password),
            'permissao' => '0'
        ]);

        $this->session->set_flashdata('success', "Cadastrado com sucesso");
        redirect('/');
    }

    public function adminRegister()
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {
            $name = $this->input->post('nome', true);
            $email = $this->input->post('email', true);
            $password = $this->input->post('senha', true);

            $this->userValidate([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);

            $this->user_model->save([
                'nome' => $name,
                'email' => $email,
                'senha' => $this->encrypt->encode($password),
                'permissao' => '1'
            ]);

            $this->session->set_flashdata('success', "Cadastrado com sucesso");
            redirect('/');
        }
        redirect('/');
    }

    protected function userValidate(array $user)
    {
        if (!$user['name'] || !$user['email'] || !$user['password']) {
            redirect('/');
        }
        $user = $this->user_model->userValidate($user['email']);

        if ($user) {
            $this->session->set_flashdata("danger", "Email já registrado no sistema");
            redirect('/');
        }
    }
}

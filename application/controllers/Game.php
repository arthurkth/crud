<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class game extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('game_model');
        $this->load->model('category_model');
    }

    public function register()
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {
            $categories = $this->category_model->all();
            $this->load->template('admin/cadastro', [
                "categories" => $categories
            ]);
            return;
        }
        redirect('/');
    }

    public function edit(int $idGame)
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {

            $game = $this->game_model->getById($idGame);
            $categories = $this->category_model->all();
            $this->load->template('admin/editar', [
                "categories" => $categories,
                "game" => $game,
            ]);
            return;
        }
        redirect('/');
    }

    public function delete($idGame)
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {

            $this->game_model->delete($idGame);
            $this->session->set_flashdata("success", "Produto excluído com sucesso");
            redirect('/');
            return;
        }
        redirect('/');
    }

    public function gameRegister()
    {
        $loggedUser = authorize();

        $image = [
            'image' => $_FILES['imagem'],
            'type' => $_FILES['imagem']['type'],
            'size' => $_FILES['imagem']['size'],
        ];

        $formData = [
            'name' => $this->input->post('nome', true),
            'plataform' => $this->input->post('plataforma', true),
            'price' => $this->input->post('preco', true),
            'haveStock' => $this->input->post('estoque', true),
            'qntStock' => $this->input->post('qtdestoque', true),
            'categoryId' => $this->input->post('categoria', true)
        ];

        $isFormValid = $this->formValidate($formData);
        $error = $this->imageValidate($image);

        if ($loggedUser == 'admin' && $error == '' && $isFormValid) {
            $content = file_get_contents($image['image']['tmp_name']);

            $this->game_model->save(
                [
                    'nome'          => $formData['name'],
                    'plataforma'    => $formData['plataform'],
                    'preco'         => $formData['price'],
                    'em_estoque'    => $formData['haveStock'],
                    'qtd_estoque'   => $formData['qntStock'],
                    'imagem'        => $content,
                    'id_categoria'  => $formData['categoryId']
                ]
            );
            $this->session->set_flashdata("success", "Produto salvo com sucesso");
            redirect('/');
        }
        $this->session->set_flashdata("danger", $error);
        redirect('/');
    }

    public function gameEdit()
    {

        $loggedUser = authorize();

        $image = [
            'image' => $_FILES['imagem'],
            'type' => $_FILES['imagem']['type'],
            'size' => $_FILES['imagem']['size'],
            'imageName' => $_FILES['imagem']['name']
        ];

        $formData = [
            'name' => $this->input->post('nome', true),
            'plataform' => $this->input->post('plataforma', true),
            'price' => $this->input->post('preco', true),
            'haveStock' => $this->input->post('estoque', true),
            'qntStock' => $this->input->post('qtdestoque', true),
            'categoryId' => $this->input->post('categoria', true),
            'gameid' => $this->input->post('gameid', true),
        ];

        $game = $this->game_model->getById($formData['gameid']);
        $oldImage = $game->imagem;

        !$loggedUser == 'admin' ? redirect('/') : true;

        if ($image['imageName'] == '') {
            $this->game_model->update(
                [
                    'id'             => $formData['gameid'],
                    'nome'           => $formData['name'],
                    'plataforma'     => $formData['plataform'],
                    'preco'          => $formData['price'],
                    'em_estoque'     => $formData['haveStock'],
                    'qtd_estoque'    => $formData['qntStock'],
                    'imagem'         => $oldImage,
                    'id_categoria'   => $formData['categoryId']
                ]
            );
            $this->session->set_flashdata("success", "Produto editado com sucesso");
            redirect('/');
        }

        $error = $this->imageValidate($image);

        if (!$error == '') {
            $this->session->set_flashdata("danger", "Por favor, insira uma imagem válida!");
            redirect('/');
        }

        $content = file_get_contents($image['image']['tmp_name']);
        $this->game_model->update(
            [
                'id'             => $formData['gameid'],
                'nome'           => $formData['name'],
                'plataforma'     => $formData['plataform'],
                'preco'          => $formData['price'],
                'em_estoque'     => $formData['haveStock'],
                'qtd_estoque'    => $formData['qntStock'],
                'imagem'         => $content,
                'id_categoria'   => $formData['categoryId']
            ]
        );

        $this->session->set_flashdata("success", "Produto editado com sucesso");
        redirect('/');
    }


    protected function imageValidate(array $image)
    {
        define('MAXIMUM_SIZE', (2 * 1920 * 1024));
        if (!isset($image)) {
            return "Por favor, selecione uma imagem";
            exit;
        }
        if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $image['type'])) {
            return 'Isso não é uma imagem válida';
            exit;
        }
        if ($image['size'] > MAXIMUM_SIZE) {
            return 'A imagem deve possuir no máximo 2MB';
        }
    }

    protected function formValidate(array $data)
    {
        foreach ($data as $row) {
            if ($row !== '') {
                return true;
            }
            redirect('/');
        }
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller
{
    public function register()
    {
        $this->load->model("Category_model");
        $loggedUser = authorize();

        if ($loggedUser == 'admin') {
            $categories = $this->Category_model->getAllCategories();
            $data = array(
                "categories" => $categories,
            );
            $this->load->template('admin/cadastro', $data);
            return;
        }
        redirect('/');
    }
    public function edit()
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {
            $idGame = $_GET['id'];
            $this->load->model('Game_model');
            $this->load->model('Category_model');
            $game = $this->Game_model->getGameById($idGame);
            $categories = $this->Category_model->getAllCategories();
            $data = array(
                "categories" => $categories,
                "game" => $game,
            );
            $this->load->template('admin/editar', $data);
            return;
        }
        redirect('/');
    }

    public function delete()
    {
        $loggedUser = authorize();
        if ($loggedUser == 'admin') {
            $this->load->model('Game_model');
            $idgame = $_GET['id'];
            $this->Game_model->deleteGame($idgame);
            $this->session->set_flashdata("success", "Produto excluído com sucesso");
            redirect('/');
            return;
        }
        redirect('/');
    }

    public function gameRegister()
    {
        $this->load->model('Game_model');
        $this->load->helper('imagevalidate');
        $loggedUser = authorize();
        $image = $_FILES['imagem'];
        $type = $image['type'];
        $size = $image['size'];
        $name = $_POST['nome'];
        $plataform = $_POST['plataforma'];
        $price = $_POST['preco'];
        $haveStock = $_POST['estoque'];
        $qntStock = $_POST['qtdestoque'];
        $categoryId = $_POST['categoria'];

        if ($loggedUser == 'admin') {
            $error = validate($image, $type, $size);
            if ($error == '') {
                $content = file_get_contents($image['tmp_name']);
                if (
                    $image != "none" && isset($name)
                    && isset($name)
                    && isset($plataform)
                    && isset($price)
                    && isset($haveStock)
                    && isset($qntStock)
                    && isset($image)
                    && isset($categoryId)
                ) {
                    $this->Game_model->save(
                        $name,
                        $plataform,
                        $price,
                        $haveStock,
                        $qntStock,
                        $categoryId,
                        $content
                    );
                    $this->session->set_flashdata("success", "Produto salvo com sucesso");
                    redirect('/');
                }
            }
            $this->session->set_flashdata("danger", $error);
            redirect('/');
        }
    }

    public function gameEdit()
    {
        $this->load->helper('imagevalidate');
        $this->load->model('Game_model');
        $image = $_FILES['imagem'];
        $type = $image['type'];
        $size = $image['size'];
        $name = $_POST['nome'];
        $plataform = $_POST['plataforma'];
        $price = $_POST['preco'];
        $haveStock = $_POST['estoque'];
        $qntStock = $_POST['qtdestoque'];
        $categoryId = $_POST['categoria'];
        $gameid = $_POST['gameid'];
        $imageName = $_FILES['imagem']['name'];
        $game = $this->Game_model->getGameById($gameid);
        $oldImage = $game['imagem'];

        if ($imageName == "") {
            // Mantém a imagem antiga
            $this->Game_model->updateGame(
                $gameid,
                $name,
                $plataform,
                $price,
                $haveStock,
                $qntStock,
                $categoryId,
                $oldImage
            );
        } else {
            $error = validate($image, $type, $size);
            if ($error == '') {
                $content = file_get_contents($image['tmp_name']);
                $this->Game_model->updateGame(
                    $gameid,
                    $name,
                    $plataform,
                    $price,
                    $haveStock,
                    $qntStock,
                    $categoryId,
                    $content
                );
            }
        }
        $this->session->set_flashdata("success", "Produto editado com sucesso");
        redirect('/');
    }
}

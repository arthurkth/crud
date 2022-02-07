<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Games extends CI_Controller
{
    public function cadastro()
    {
        $this->load->model("Category");
        $usuarioLogado = autoriza();

        if ($usuarioLogado == 'admin') {
            $categories = $this->Category->getAllCategories();
            $data = array(
                "categories" => $categories,
            );
            $this->load->template('admin/cadastro', $data);
            return;
        }
        redirect('/');
    }
    public function editar()
    {
        $usuarioLogado = autoriza();
        if ($usuarioLogado == 'admin') {
            $idGame = $_GET['id'];
            $this->load->model('Game');
            $this->load->model('Category');
            $game = $this->Game->getGameById($idGame);
            $categories = $this->Category->getAllCategories();
            $data = array(
                "categories" => $categories,
                "game" => $game,
            );
            $this->load->template('admin/editar', $data);
            return;
        }
        redirect('/');
    }

    public function excluir()
    {
        $usuarioLogado = autoriza();
        if ($usuarioLogado == 'admin') {
            $this->load->model('Game');
            $idgame = $_GET['id'];
            $this->Game->deleteGame($idgame);
            $this->session->set_flashdata("success", "Produto excluído com sucesso");
            redirect('/');
            return;
        }
        redirect('/');
    }

    public function cadastrarjogo()
    {
        $this->load->model('Game');
        $this->load->helper('imagevalidate');
        $usuarioLogado = autoriza();
        $imagem = $_FILES['imagem'];
        $tipo = $imagem['type'];
        $tamanho = $imagem['size'];
        $nome = $_POST['nome'];
        $plataforma = $_POST['plataforma'];
        $preco = $_POST['preco'];
        $emEstoque = $_POST['estoque'];
        $qtdEstoque = $_POST['qtdestoque'];
        $categoria = $_POST['categoria'];

        if ($usuarioLogado == 'admin') {
            $erro = validate($imagem, $tipo, $tamanho);
            if ($erro == '') {
                $conteudo = file_get_contents($imagem['tmp_name']);
                if (
                    $imagem != "none" && isset($nome)
                    && isset($nome)
                    && isset($plataforma)
                    && isset($preco)
                    && isset($emEstoque)
                    && isset($qtdEstoque)
                    && isset($imagem)
                    && isset($categoria)
                ) {
                    $this->Game->save(
                        $nome,
                        $plataforma,
                        $preco,
                        $emEstoque,
                        $qtdEstoque,
                        $categoria,
                        $conteudo
                    );
                    $this->session->set_flashdata("success", "Produto salvo com sucesso");
                    redirect('/');
                }
            }
            $this->session->set_flashdata("danger", $erro);
            redirect('/');
        }
    }

    public function editarjogo()
    {
        $this->load->helper('imagevalidate');
        $this->load->model('Game');
        $imagem = $_FILES['imagem'];
        $tipo = $imagem['type'];
        $tamanho = $imagem['size'];
        $nome = $_POST['nome'];
        $plataforma = $_POST['plataforma'];
        $preco = $_POST['preco'];
        $emEstoque = $_POST['estoque'];
        $qtdEstoque = $_POST['qtdestoque'];
        $idcategoria = $_POST['categoria'];
        $gameid = $_POST['gameid'];
        $imagemName = $_FILES['imagem']['name'];
        $game = $this->Game->getGameById($gameid);
        $imagemAntiga = $game['imagem'];

        if ($imagemName == "") {
            // Mantém a imagem antiga
            $this->Game->updateGame(
                $gameid,
                $nome,
                $plataforma,
                $preco,
                $emEstoque,
                $qtdEstoque,
                $idcategoria,
                $imagemAntiga
            );
        } else {
            $erro = validate($imagem, $tipo, $tamanho);
            if ($erro == '') {
                $conteudo = file_get_contents($imagem['tmp_name']);
                $this->Game->updateGame(
                    $gameid,
                    $nome,
                    $plataforma,
                    $preco,
                    $emEstoque,
                    $qtdEstoque,
                    $idcategoria,
                    $conteudo
                );
            }
        }
        $this->session->set_flashdata("success", "Produto editado com sucesso");
        redirect('/');
    }
}

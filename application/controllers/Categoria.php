<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Controller
{
    public function index()
    {
        $this->load->model('Category');
        $this->load->model('Game');
        $idcategoria = $_GET['id'];
        $categoria = $this->Category->getCategoryById($idcategoria);
        $categorias = $this->Category->getAllCategories();
        $jogosdacategoria = $this->Game->getGamesByCategoryId($idcategoria);
        $data = array(
            "games" => $jogosdacategoria,
            "category" => $categoria,
            "categories" => $categorias
        );
        $this->load->template('categoria', $data);
    }
}

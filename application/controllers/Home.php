<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $usuarioLogado = autoriza();
        $this->load->model("Game");
        $this->load->model("Category");
        $games = $this->Game->getAllGames();
        $categories = $this->Category->getAllCategories();
        $data = array("games" => $games, "categories" => $categories);
        if($usuarioLogado == 'admin') {
            $this->load->template('admin/home', $data);
            return;     
        } 
        $this->load->template("home", $data);
    }
}

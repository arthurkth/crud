<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $loggedUser = authorize();
        $this->load->model("Game_model");
        $this->load->model("Category_model");
        $games = $this->Game_model->getAllGames();
        $categories = $this->Category_model->getAllCategories();
        $data = array("games" => $games, "categories" => $categories);
        if($loggedUser == 'admin') {
            $this->load->template('admin/home', $data);
            return;     
        } 
        $this->load->template("home", $data);
    }
}

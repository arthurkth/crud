<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller
{
    public function index()
    {
        $loggedUser = authorize();
        $this->load->model("game_model");
        $this->load->model("category_model");

        $games = $this->game_model->getAllGames();
        $categories = $this->category_model->all();

        $data = [
            "games" => $games,
            "categories" => $categories
        ];

        if ($loggedUser == 'admin') {
            $this->load->template('admin/home', $data);
            return;
        }

        $this->load->template("home", $data);
    }
}

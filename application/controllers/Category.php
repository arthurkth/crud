<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function index()
    {
        $this->load->model('Category_model');
        $this->load->model('Game_model');
        $categoryid = $_GET['id'];
        $category = $this->Category_model->getCategoryById($categoryid);
        $categories = $this->Category_model->getAllCategories();
        $categorygames = $this->Game_model->getGamesByCategoryId($categoryid);
        $data = array(
            "games" => $categorygames,
            "category" => $category,
            "categories" => $categories
        );
        $this->load->template('category', $data);
    }
}

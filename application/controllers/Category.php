<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class category extends CI_Controller
{
    public function index($categoryId)
    {
        $this->load->model('category_model');
        $this->load->model('game_model');

        $this->load->template('category', [
            "games"      => $this->getGamesCategory($categoryId),
            "category"   => $this->category_model->getById($categoryId),
            "categories" => $this->category_model->all()
        ]);
    }

    protected function getGamesCategory($categoryId)
    {
        $this->db->select([
            'g.*',
            'c.nome AS nome_categoria'
        ]);
        $this->db->from('game g');
        $this->db->join('categoria c', 'c.id = g.id_categoria', 'left');
        $this->db->where('g.id_categoria', $categoryId);

        return $this->db->get()->result();
    }
}

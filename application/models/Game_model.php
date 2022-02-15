<?php
class game_model extends My_Model
{

    protected $table = 'game';
  

    public function getAllGames()
    {
        $this->db->select([
            'g.*',
            'c.nome AS nome_categoria'
        ]);
        $this->db->from('game g');
        $this->db->join('categoria c', 'c.id = g.id_categoria', 'left');

        return $this->db->get()->result();
    }


    public function getGamesByCategoryId($id)
    {
        return $this->db->get_where("game", array(
            "id_categoria" => $id
        ))->result_array();
    }
}

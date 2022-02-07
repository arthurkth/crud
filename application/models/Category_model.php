<?php
class Category_model extends CI_Model
{

  public function getAllCategories()
  {
    $query = $this->db->query("SELECT id,nome FROM categoria");
    $category = [];
    foreach ($query->result_array() as $row) {
      array_push($category, $row);
    }
    return $category;
  }

  public function getCategoryById($id)
  {
    return $this->db->get_where("categoria", array(
      "id" => $id
    ))->row_array();
  }

  public function getCategoryByGameId($id)
  {
    $game = $this->db->getGameById($id);
    $query = '
    SELECT categoria.nome FROM game
    JOIN categoria ON categoria.id = id_categoria';
  }
}

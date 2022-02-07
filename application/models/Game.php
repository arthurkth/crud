<?php
class Game extends CI_Model
{
    public function save($nome, $plataforma, $preco, $emEstoque, $qtdEstoque, $categoria, $imagem)
    {
        $this->db->insert('game', array(
            "nome" => $nome,
            "plataforma" => $plataforma,
            "preco" => $preco,
            "em_estoque" => $emEstoque,
            "qtd_estoque" => $qtdEstoque,
            "imagem" => $imagem,
            "id_categoria" => $categoria
        ));
    }

    public function getAllGames()
    {
        $query = $this->db->query("SELECT * FROM game");
        $games = [];
        foreach ($query->result_array() as $row) {
            array_push($games, $row);
        }

        return $games;
    }

    public function getGameById($id)
    {
        return $this->db->get_where("game", array(
            "id" => $id
        ))->row_array();
    }

    public function updateGame($id, $nome, $plataforma, $preco, $emEstoque, $qtdEstoque, $categoria, $imagem)
    {
        $data = [
            "nome" => $nome,
            "plataforma" => $plataforma,
            "preco" => $preco,
            "em_estoque" => $emEstoque,
            "qtd_estoque" => $qtdEstoque,
            "imagem" => $imagem,
            "id_categoria" => $categoria
        ];
        $this->db->where('id', $id);
        $this->db->update('game', $data);
    }

    public function deleteGame($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('game');
    }

    public function getGamesByCategoryId($id)
    {
        return $this->db->get_where("game", array(
            "id_categoria" => $id
        ))->result_array();
    }
}

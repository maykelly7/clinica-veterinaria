<?php
// classes/Animal.php

require_once 'Database.php';

class Animal {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrar($nome, $especie, $raca, $idade, $dono_nome, $telefone, $foto_caminho = null) {
        $data = [
            'nome' => $nome,
            'especie' => $especie,
            'raca' => $raca,
            'idade' => $idade,
            'dono_nome' => $dono_nome,
            'telefone' => $telefone,
            'foto_caminho' => $foto_caminho // Adiciona o caminho da foto ao array de dados
        ];
        return $this->db->insert('animais', $data); // Usa o método insert da classe Database
    }

    public function listar() {
        return $this->db->select('animais'); // Usa o método select da classe Database
    }

    public function editar($id, $nome, $especie, $raca, $idade, $dono_nome, $telefone, $foto_caminho = null) {
        $data = [
            'nome' => $nome,
            'especie' => $especie,
            'raca' => $raca,
            'idade' => $idade,
            'dono_nome' => $dono_nome,
            'telefone' => $telefone,
            'foto_caminho' => $foto_caminho // Adiciona o caminho da foto ao array de dados
        ];
        $conditions = ['id' => $id];
        return $this->db->update('animais', $data, $conditions); // Usa o método update da classe Database
    }

    public function deletar($id) {
        $conditions = ['id' => $id];
        return $this->db->delete('animais', $conditions); // Usa o método delete da classe Database
    }
}
?>
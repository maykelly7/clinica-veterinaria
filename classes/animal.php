<?php
// classes/Animal.php

require_once 'Database.php';

class Animal {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function cadastrar($nome, $especie, $raca, $idade, $dono_nome, $telefone) {
        $data = [
            'nome' => $nome,
            'especie' => $especie,
            'raca' => $raca,
            'idade' => $idade,
            'dono_nome' => $dono_nome,
            'telefone' => $telefone
        ];
        return $this->db->insert('animais', $data);
    }

    public function listar() {
        return $this->db->select('animais');
    }

    public function editar($id, $nome, $especie, $raca, $idade, $dono_nome, $telefone) {
        $data = [
            'nome' => $nome,
            'especie' => $especie,
            'raca' => $raca,
            'idade' => $idade,
            'dono_nome' => $dono_nome,
            'telefone' => $telefone
        ];
        $conditions = ['id' => $id];
        return $this->db->update('animais', $data, $conditions);
    }

    public function deletar($id) {
        $conditions = ['id' => $id];
        return $this->db->delete('animais', $conditions);
    }
}
?>
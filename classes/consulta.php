<?php
// classes/Consulta.php

require_once 'Database.php';

class Consulta {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function agendar($animal_id, $data_consulta, $descricao) {
        $data = [
            'animal_id' => $animal_id,
            'data_consulta' => $data_consulta,
            'descricao' => $descricao
        ];
        return $this->db->insert('consultas', $data);
    }

    public function listar($conditions = []) {
        $query = "SELECT id, animal_id, data, descricao, realizada FROM consultas";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = '$v'", array_keys($conditions), array_values($conditions)));
        }
        return $this->db->execute($query);
    }

    public function editar($id, $animal_id, $data_consulta, $descricao) {
        $data = [
            'animal_id' => $animal_id,
            'data_consulta' => $data_consulta,
            'descricao' => $descricao
        ];
        $conditions = ['id' => $id];
        return $this->db->update('consultas', $data, $conditions);
    }

    public function deletar($id) {
        $conditions = ['id' => $id];
        return $this->db->delete('consultas', $conditions);
    }

    public function marcarComoRealizada($id) {
        $query = "UPDATE consultas SET realizada = 1 WHERE id = $id";
        return $this->db->execute($query);
    }
}
?>
<?php
// classes/Consulta.php

require_once 'Database.php';

class Consulta {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Método para agendar uma consulta
    public function agendar($animal_id, $data, $descricao) {
        $data = [
            'animal_id' => $animal_id,
            'data' => $data, // Use 'data' em vez de 'data_consulta'
            'descricao' => $descricao
        ];
        return $this->db->insert('consultas', $data);
    }

    // Método para listar consultas
    public function listar($conditions = []) {
        $query = "SELECT id, animal_id, data, descricao, realizada FROM consultas";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = '$v'", array_keys($conditions), array_values($conditions)));
        }
        return $this->db->execute($query);
    }

    // Método para editar uma consulta
    public function editar($id, $animal_id, $data, $descricao) {
        $data = [
            'animal_id' => $animal_id,
            'data' => $data, // Use 'data' em vez de 'data_consulta'
            'descricao' => $descricao
        ];
        $conditions = ['id' => $id];
        return $this->db->update('consultas', $data, $conditions);
    }

    // Método para deletar uma consulta
    public function deletar($id) {
        $conditions = ['id' => $id];
        return $this->db->delete('consultas', $conditions);
    }

    // Método para marcar uma consulta como realizada
    public function marcarComoRealizada($id) {
        $query = "UPDATE consultas SET realizada = 1 WHERE id = $id";
        return $this->db->execute($query);
    }
}
?>
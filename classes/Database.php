<?php
// classes/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'clinica_veterinaria';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function execute($query) {
        try {
            $result = $this->conn->query($query);
            if (!$result) {
                throw new mysqli_sql_exception($this->conn->error);
            }
            return $result;
        } catch (mysqli_sql_exception $e) {
            // Log do erro (opcional)
            error_log("Database error: " . $e->getMessage());
    
            // Exibir mensagem amigável
            die("Ocorreu um erro no banco de dados. Por favor, tente novamente mais tarde.");
        }
    }

    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO $table ($columns) VALUES ($values)";
        return $this->execute($query);
    }

    public function select($table, $conditions = []) {
        $query = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", array_map(fn($k, $v) => "$k = '$v'", array_keys($conditions), array_values($conditions)));
        }
        return $this->execute($query);
    }

    public function update($table, $data, $conditions) {
        $set = implode(", ", array_map(fn($k, $v) => "$k = '$v'", array_keys($data), array_values($data)));
        $where = implode(" AND ", array_map(fn($k, $v) => "$k = '$v'", array_keys($conditions), array_values($conditions)));
        $query = "UPDATE $table SET $set WHERE $where";
        return $this->execute($query);
    }

    public function delete($table, $conditions) {
        $where = implode(" AND ", array_map(fn($k, $v) => "$k = '$v'", array_keys($conditions), array_values($conditions)));
        $query = "DELETE FROM $table WHERE $where";
        return $this->execute($query);
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>
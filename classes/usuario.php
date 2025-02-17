<?php
// classes/Usuario.php

require_once 'Database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Verificar login
    public function login($email, $senha) {
        $result = $this->db->select('usuarios', ['email' => $email]);
        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            if (password_verify($senha, $usuario['senha'])) {
                return $usuario; // Retorna os dados do usuário
            }
        }
        return false;
    }


    // Cadastrar usuário
    public function cadastrar($nome, $email, $senha, $tipo) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $data = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senhaHash,
            'tipo' => $tipo
        ];
        return $this->db->insert('usuarios', $data);
    }

}
?>

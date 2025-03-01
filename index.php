<?php
// index.php

require_once 'classes/animal.php';
require_once 'classes/consulta.php';

$animal = new Animal();
$consulta = new Consulta();

// Cadastrar Animal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_animal'])) {
    $animal->cadastrar($_POST['nome'], $_POST['especie'], $_POST['raca'], $_POST['idade'], $_POST['dono_nome'], $_POST['telefone']);
}

// Listar Animais
$animais = $animal->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Clínica Veterinária</title>
    <link rel="stylesheet" href="public/index.css">
</head>
<body>
    <h1>AnimalVet</h1>

    <!-- Links para as páginas de login -->

    <div class="form-logo">
        <img src="src/logo-clinica.webp" alt="">
    </div>

    <div class="login-buttons">
        <a href="dashboard/admin/dashboard/login_admin.php" class="button">Login Adm</a>
        <a href="dashboard/cliente/dashboard/login_cliente.php" class="button">Login Cliente</a>
    </div>


   
</body>
</html>
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Clínica Veterinária</h1>

    <a href="dashboard/admin/login/login_admin.php"><button>Login Adm</button></a>

    <a href="dashboard/cliente/login/login_cliente.php"><button>Login cliente</button></a>

    
</body>
</html>
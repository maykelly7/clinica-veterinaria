<?php
// admin/dashboard/listar_consultas.php

session_start();

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'admin') {
    header("Location: ../../admin/login/login_admin.php");
    exit();
}

require_once '../../classes/Consulta.php';
require_once '../../classes/Animal.php';

$consulta = new Consulta();
$consultas = $consulta->listar();

$animal = new Animal();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Consultas</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <h1>Lista de Consultas</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Animal</th>
            <th>Dono</th>
            <th>Data da Consulta</th>
            <th>Descrição</th>
        </tr>
        <?php while ($row = $consultas->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>
                <?php
                $animal_data = $animal->listar(['id' => $row['animal_id']])->fetch_assoc();
                echo $animal_data['nome'] . " (" . $animal_data['especie'] . ")";
                ?>
            </td>
            <td><?= $animal_data['dono_nome'] ?></td>
            <td><?= $row['data_consulta'] ?></td>
            <td><?= $row['descricao'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="index.php">Voltar ao Dashboard</a>
</body>
</html>
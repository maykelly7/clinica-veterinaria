<?php
// cliente/dashboard/agendar_consulta.php

session_start();

// Verifica se o usuário está logado e se é um cliente
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'cliente') {
    header("Location: ../../cliente/login/login_cliente.php");
    exit();
}

require_once '../../../classes/Consulta.php';
require_once '../../../classes/Animal.php';

$consulta = new Consulta();
$animal = new Animal();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agendar_consulta'])) {
    $animal_id = $_POST['animal_id'];
    $data_consulta = $_POST['data_consulta'];
    $descricao = $_POST['descricao'];

    if ($consulta->agendar($animal_id, $data_consulta, $descricao)) {
        echo "Consulta agendada com sucesso!";
    } else {
        echo "Erro ao agendar consulta.";
    }
}

// Lista apenas os animais do cliente logado
$animais = $animal->listar(['dono_nome' => $_SESSION['usuario']['nome']]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agendar Consulta</title>
    <link rel="stylesheet" href="../../../public/agendar_consulta.css">
</head>
<body>
    <h1>Agendar Consulta</h1>

    <form method="POST">
        <label for="animal_id">Animal:</label>
        <select name="animal_id" required>
            <?php while ($row = $animais->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>"><?= $row['nome'] ?> (<?= $row['especie'] ?>)</option>
            <?php endwhile; ?>
        </select>

        <label for="data_consulta">Data da Consulta:</label>
        <input type="date" name="data_consulta" required>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" placeholder="Descrição da consulta"></textarea>

        <button type="submit" name="agendar_consulta">Agendar Consulta</button>
    </form>

    <a href="deahboard_cliente.php">Voltar ao Dashboard</a>
</body>
</html>
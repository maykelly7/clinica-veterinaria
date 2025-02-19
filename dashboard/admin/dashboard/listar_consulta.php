<?php
// admin/dashboard/listar_consultas.php

session_start();

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'admin') {
    header("Location: ../../admin/login/login_admin.php");
    exit();
}

require_once '../../../classes/Consulta.php';
require_once '../../../classes/Animal.php';

$consulta = new Consulta();
$consultas = $consulta->listar();

$animal = new Animal();

// Verifica se uma consulta foi marcada como realizada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_consulta'])) {
    $consulta->marcarComoRealizada($_POST['consulta_id']);
    header("location:listar_consulta.php"); // Recarrega a página para atualizar o status
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Listar Consultas</title>
    <link rel="stylesheet" href="../../../public/listar_consulta.css">
</head>
<body>
    <h1>Lista de Consultas</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Animal</th>
            <th>Dono</th>
            <th>Data da Consulta</th>
            <th>Descrição</th>
            <th>Realizada</th>
            <th>Ação</th>
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
                <td><?= $row['data'] ?></td> <!-- Corrigido para 'data' -->
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['realizada'] ? ' Sim' : ' Não' ?></td>
                <td>
                    <?php if (!$row['realizada']): ?>
                        <form method="POST">
                            <input type="hidden" name="consulta_id" value="<?= $row['id'] ?>">
                            <button type="submit" name="confirmar_consulta">Confirmar</button>
                        </form>
                    <?php else: ?>
                        <span> Concluída</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="index_admin.php">Voltar ao Dashboard</a>
</body>
</html>
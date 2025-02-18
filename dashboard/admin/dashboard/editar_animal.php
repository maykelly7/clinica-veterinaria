<?php
// editar_animal.php

require_once '../../../classes/Animal.php';
require_once '../../../classes/Consulta.php';

$animal = new Animal();
$consulta = new Consulta();

// Editar animal
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_animal'])) {
    $animal->editar($_POST['id'], $_POST['nome'], $_POST['especie'], $_POST['raca'], $_POST['idade'], $_POST['dono_nome'], $_POST['telefone']);
    header("Location:deahboard_admin.php");
    exit();
}

// Marcar consulta como realizada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['marcar_consulta'])) {
    $consulta_id = $_POST['consulta_id'];
    $consulta->marcarComoRealizada($consulta_id);
    header("Location: editar_animal.php?id=" . $_GET['id']); // Recarrega a página
    exit();
}

// Buscar dados do animal para edição
$id = $_GET['id'];
$animais = $animal->listar(['id' => $id]);
$animal_data = $animais->fetch_assoc();

// Listar todas as consultas do animal
$consultas = $consulta->listar(['animal_id' => $id]);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .realizada {
            background-color: #d4edda;
        }
    </style>
</head>
<body>
    <h1>Editar Animal</h1>

    <!-- Formulário para editar o animal -->
    <form method="POST">
        <input type="hidden" name="id" value="<?= $animal_data['id'] ?>">
        <input type="text" name="nome" placeholder="Nome" value="<?= $animal_data['nome'] ?>" required>
        <input type="text" name="especie" placeholder="Espécie" value="<?= $animal_data['especie'] ?>" required>
        <input type="text" name="raca" placeholder="Raça" value="<?= $animal_data['raca'] ?>">
        <input type="number" name="idade" placeholder="Idade" value="<?= $animal_data['idade'] ?>">
        <input type="text" name="dono_nome" placeholder="Nome do Dono" value="<?= $animal_data['dono_nome'] ?>" required>
        <input type="text" name="telefone" placeholder="Telefone" value="<?= $animal_data['telefone'] ?>">
        <button type="submit" name="editar_animal">Salvar</button>
    </form>

    <!-- Tabela de consultas do animal -->
    <h2>Consultas</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Data</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($consulta_data = $consultas->fetch_assoc()): ?>
                <tr class="<?= $consulta_data['realizada'] ? 'realizada' : '' ?>">
                    <td><?= $consulta_data['id'] ?></td>
                    <td><?= $consulta_data['data'] ?></td>
                    <td><?= $consulta_data['descricao'] ?></td>
                    <td><?= $consulta_data['realizada'] ? 'Realizada' : 'Pendente' ?></td>
                    <td>
                        <?php if (!$consulta_data['realizada']): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="consulta_id" value="<?= $consulta_data['id'] ?>">
                                <button type="submit" name="marcar_consulta">Marcar como realizada</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
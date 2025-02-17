<?php
// listar_animais.php

require_once 'classes/animal.php';

$animal = new Animal();
$animais = $animal->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Animais</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Lista de Animais</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Espécie</th>
            <th>Raça</th>
            <th>Idade</th>
            <th>Dono</th>
            <th>Telefone</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $animais->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nome'] ?></td>
            <td><?= $row['especie'] ?></td>
            <td><?= $row['raca'] ?></td>
            <td><?= $row['idade'] ?></td>
            <td><?= $row['dono_nome'] ?></td>
            <td><?= $row['telefone'] ?></td>
            <td>
                <a href="editar_animal.php?id=<?= $row['id'] ?>">Editar</a>
                <a href="deletar_animal.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <a href="cadastrar_animal.php">Cadastrar Novo Animal</a>
    <a href="listar_consultas.php">Ver Consultas</a>
</body>
</html>
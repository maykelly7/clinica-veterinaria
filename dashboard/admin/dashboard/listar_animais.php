<?php

require_once '../../../classes/animal.php';

$animal = new Animal();
$animais = $animal->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Animais</title>
    <link rel="stylesheet" href="../../../public/listar_animal.css">
     
</head>
<body>
    <h1>Lista de Animais</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Foto</th>
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
            <td>
                <?php if (!empty($row['foto_caminho'])): ?>
                    <img src="<?= $row['foto_caminho'] ?>" alt="Foto do Animal" class="foto-animal">
                <?php else: ?>
                    Sem foto
                <?php endif; ?>
            </td>
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

    
</body>
</html>
<?php
// deletar_animal.php

require_once 'classes/Animal.php';

$animal = new Animal();

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($animal->deletar($id)) {
        echo "Animal deletado com sucesso!";
    } else {
        echo "Erro ao deletar animal.";
    }

    // Redirecionar para a lista de animais após deletar
    header("Location: listar_animais.php");
    exit();
}
?>
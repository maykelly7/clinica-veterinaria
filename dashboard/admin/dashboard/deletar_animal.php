<?php
require_once '../../../classes/Database.php';
require_once '../../../classes/animal.php';

$database = new Database();
$animal = new Animal($database);

$id_animal = $_GET['id']; // Supondo que o ID do animal seja passado via URL

// 1. Deletar as consultas associadas ao animal
$database->delete('consultas', ['animal_id' => $id_animal]);

// 2. Deletar o animal
$result = $database->delete('animais', ['id' => $id_animal]);

if ($result) {
   header('location:listar_animais.php');
} else {
    echo "Erro ao deletar o animal.";
}
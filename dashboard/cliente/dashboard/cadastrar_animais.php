<?php

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] != 'cliente') {
    header("Location: ../../cliente/login/login_cliente.php");
    exit();
}

require_once '../../../classes/Animal.php';
require_once '../../../classes/Database.php';

$animal = new Animal();
$db = new Database();

$especies = $db->select('especies'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_animal'])) {
    // Processa o upload da foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $arquivo = $_FILES['foto'];
        $pasta = '../../../upload/fotos/';

        if (!file_exists($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nome_foto = $arquivo['name'];
        $novo_nome = uniqid();
        $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));

        if ($extensao != 'png' && $extensao != 'jpg' && $extensao != 'jpeg') {
            die("Extensão de arquivo inválida. Apenas PNG, JPG e JPEG são permitidos.");
        }

        $caminho = $pasta . $novo_nome . '.' . $extensao;

        if (!move_uploaded_file($arquivo['tmp_name'], $caminho)) {
            die("Falha ao mover o arquivo.");
        }
    } else {
        $caminho = null;
    }

    // Dados do formulário
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $dono_nome = $_SESSION['usuario']['nome'];
    $telefone = $_POST['telefone'];


    if ($animal->cadastrar($nome, $especie, $raca, $idade, $dono_nome, $telefone, $caminho)) {
        $mensagem = "Animal cadastrado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar animal.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Animal</title>
    <link rel="stylesheet" href="../../../public/cadastrar_animal.css">
    
</head>
<body>
    <div class="container">
        <h1>Cadastrar Animal</h1>
        <?php if (isset($mensagem)): ?>
            <div class="mensagem <?php echo strpos($mensagem, 'Erro') !== false ? 'erro' : ''; ?>">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome" required>
            
         
            <label for="especie">Espécie:</label>
            <select name="especie" id="especie" required>
                <option value="">Selecione uma espécie</option>
                <?php foreach ($especies as $especie): ?>
                    <option value="<?php echo $especie['nome']; ?>"><?php echo $especie['nome']; ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="raca" placeholder="Raça">
            <input type="number" name="idade" placeholder="Idade">
            <input type="text" name="telefone" placeholder="Telefone" required>

          
            <label for="foto">Foto do Animal:</label>
            <input type="file" name="foto" id="foto" accept="image/png, image/jpeg">

            <button type="submit" name="cadastrar_animal">Cadastrar</button>
        </form>
        <a href="dashboard_cliente.php">Voltar ao Dashboard</a>
    </div>
</body>
</html>
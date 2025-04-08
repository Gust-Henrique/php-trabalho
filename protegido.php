<?php
session_start();

include 'funcoes.php';

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['novos_personagens'])) {
    $_SESSION['novos_personagens'] = [];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $imagem = $_POST['imagem'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $categoria = $_POST['categoria'] ?? '';

    $ultimo_id = 0;
    if (!empty($_SESSION['novos_personagens'])) {
        $ultimo_id = end($_SESSION['novos_personagens'])['id'];
    }

    $novo = [
        "id" => $ultimo_id + 100,
        "nome" => $nome,
        "imagem" => $imagem,
        "descricao" => $descricao,
        "categoria" => $categoria
    ];

    $_SESSION['novos_personagens'][] = $novo;
    $mensagem = "Personagem cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área Protegida - Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">

    <nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="index.php">Catálogo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPersonagens" aria-controls="navbarPersonagens" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarPersonagens">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['logado']) && $_SESSION['logado'] == true): ?>
                        <li class="nav-item">
                            <a href="logout.php" class="btn btn-danger">Deslogar</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-light">Login/Novo Cadastro</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <h2 class="mb-4 text-center">Cadastrar Novo Personagem</h2>

    <?php if (isset($mensagem)): ?>
        <div class="alert alert-success"><?= $mensagem ?></div>
    <?php endif; ?>

    <form method="POST" action="protegido.php">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">URL da Imagem</label>
            <input type="text" name="imagem" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <input type="text" name="categoria" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    <div class="mt-4">
        <a href="index.php" class="btn btn-primary">Voltar ao catálogo</a>
    </div>
</div>
    <footer class="footer">
        <p><?php mensagemRodape() ?></p>
    </footer>
</body>
</html>

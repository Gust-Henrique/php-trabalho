<?php

session_start();

include 'dados.php';

include 'funcoes.php';

$todos_personagens = $personagens;
if (isset($_SESSION['novos_personagens'])) {
    $todos_personagens = array_merge($personagens, $_SESSION['novos_personagens']);
}

$categoriaEscolhida = isset($_GET['categoria']) ? $_GET['categoria'] : null;

$personagensFiltrados = [];
if ($categoriaEscolhida) {
    foreach ($todos_personagens as $p) {
        if (strtolower($p['categoria']) === strtolower($categoriaEscolhida)) {
            $personagensFiltrados[] = $p;
        }
    }
} else {
    $personagensFiltrados = $todos_personagens;
}

$categorias = array_unique(array_map(function ($p) {
    return $p['categoria'];
}, $todos_personagens));
sort($categorias);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por Categoria</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>
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
    <h1 class="text-center mb-4">Filtrar Personagens por Categoria</h1>

    <form method="get" class="mb-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <select name="categoria" class="form-select">
                    <option value="">-- Todas as Categorias --</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($cat === $categoriaEscolhida) ? 'selected' : '' ?>>
                            <?= $cat ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light">Filtrar</button>
            </div>
        </div>
    </form>

    <div class="row">
        <?php foreach ($personagensFiltrados as $personagem): ?>
            <div class="col-md-4 mb-4">
                <div class="card bg-secondary text-white">
                    <img src="<?= $personagem['imagem'] ?>" class="card-img-top" alt="<?= $personagem['nome'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $personagem['nome'] ?></h5>
                        <p class="card-text"><strong>Categoria:</strong> <?= $personagem['categoria'] ?></p>
                        <a href="detalhes.php?id=<?= $personagem['id'] ?>" class="btn btn-light">Ver mais</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="index.php" style="margin-bottom:10px" class="btn btn-outline-light mt-4">Voltar ao Catálogo</a>
</div>

    <footer class="footer">
        <p><?php mensagemRodape() ?></p>
    </footer>
</body>
</html>

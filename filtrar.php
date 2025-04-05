<?php
include 'dados.php';

$categoriaEscolhida = isset($_GET['categoria']) ? $_GET['categoria'] : null;

$personagensFiltrados = [];
if ($categoriaEscolhida) {
    foreach ($personagens as $p) {
        if (strtolower($p['categoria']) === strtolower($categoriaEscolhida)) {
            $personagensFiltrados[] = $p;
        }
    }
} else {
    $personagensFiltrados = $personagens;
}

$categorias = array_unique(array_map(function ($p) {
    return $p['categoria'];
}, $personagens));
sort($categorias);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .footer {
            text-align: center;
            background-color: black;
            padding: 5px;
            margin-top: auto;
        }
        .card-img-top {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
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

    <a href="index.php" class="btn btn-outline-light mt-4">Voltar ao Catálogo</a>
</div>
<footer class="footer">
        <p>Trabalho feito por Gustavo e Samuel para a aula de PHP</p>
</footer>

</body>
</html>

<?php
session_start();

include 'dados.php';
include 'funcoes.php';

$todos_personagens = $personagens;
if (isset($_SESSION['novos_personagens'])) {
    $todos_personagens = array_merge($personagens, $_SESSION['novos_personagens']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Personagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-dark text-white">

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
                            <a href="protegido.php" class="nav-link text-light">Cadastrar Personagem</a>
                        </li>
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

    <div class="container mt-5 pt-5">

        <h1 class="text-center mb-4">Catálogo de Personagens de Anime</h1>
        <div class="d-flex justify-content-end mb-3">
            <a href="filtrar.php" class="btn btn-outline-light">Filtrar</a>
        </div>

        <div class="row">
            <?php foreach ($todos_personagens as $personagem): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="<?php echo htmlspecialchars($personagem['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($personagem['nome']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($personagem['nome']); ?></h5>
                            <p class="card-text"><strong>Categoria:</strong> <?php echo htmlspecialchars($personagem['categoria']); ?></p>
                            <a href="detalhes.php?id=<?php echo $personagem['id']; ?>" class="btn btn-light">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer class="footer">
        <p><?php mensagemRodape(); ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

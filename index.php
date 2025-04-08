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
    <div class="container mt-5">

        <h1 class="text-center mb-4">Catálogo de Personagens de Anime</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="protegido.php" class="btn btn-light">Cadastrar Personagem</a>
            <?php
            if (isset($_SESSION['logado']) || $_SESSION['logado'] == true): ?>
                <a href="logout.php" class="btn btn-danger">Deslogar</>
            <?php endif; ?>
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
        <p><?php mensagemRodape() ?></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

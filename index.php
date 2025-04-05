<?php
include 'dados.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Personagens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Catálogo de Personagens de Anime</h1>     
        <a href="filtrar.php" class="btn btn-light">Filtrar</a>
        <div class="row">
            <?php foreach ($personagens as $personagem): ?>
                <div class="col-md-4 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="<?php echo $personagem['imagem']; ?>" class="card-img-top" alt="<?php echo $personagem['nome']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $personagem['nome']; ?></h5>
                            <p class="card-text"><strong>Categoria:</strong> <?php echo $personagem['categoria']; ?></p>
                            <a href="detalhes.php?id=<?php echo $personagem['id']; ?>" class="btn btn-light">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

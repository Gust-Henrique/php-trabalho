<?php
session_start();

include 'dados.php';
include 'funcoes.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

$todos_personagens = $personagens;
if (isset($_SESSION['novos_personagens'])) {
    $todos_personagens = array_merge($personagens, $_SESSION['novos_personagens']);
}

$personagemSelecionado = null;
foreach ($todos_personagens as $personagem) {
    if ($personagem['id'] == $id) {
        $personagemSelecionado = $personagem;
        break;
    }
}

if (!$personagemSelecionado) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Personagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
        <h1 class="text-center mb-4"><?php echo htmlspecialchars($personagemSelecionado['nome']); ?></h1>
        <div class="card bg-secondary text-white mx-auto" style="max-width: 600px;">
            <img src="<?php echo htmlspecialchars($personagemSelecionado['imagem']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($personagemSelecionado['nome']); ?>">
            <div class="card-body">
                <p><strong>Categoria:</strong> <?php echo htmlspecialchars($personagemSelecionado['categoria']); ?></p>
                <p><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($personagemSelecionado['descricao'])); ?></p>
                <a href="index.php" class="btn btn-light">Voltar</a>
            </div>
        </div>
    </div>
    <footer class="footer">
        <p><?php mensagemRodape() ?></p>
    </footer>

</body>
</html>

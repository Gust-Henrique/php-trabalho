<?php
session_start();

include 'dados.php';

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
    </style>
</head>
<body class="bg-dark text-white">

    <div class="container mt-5">
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
        <p>Trabalho feito por Gustavo e Samuel para a aula de PHP</p>
    </footer>

</body>
</html>

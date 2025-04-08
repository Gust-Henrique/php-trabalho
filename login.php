<?php

session_start();

$usuario_correto = 'admin';
$hash_senha_correta = '$2y$10$7wFdgUjycpQOLM2Ave4X8uAXxATG4a/E3de3mnxIVM/dc.tcLGscq';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario === $usuario_correto && password_verify($senha, $hash_senha_correta)) {
        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;
        header('Location: protegido.php');
        exit;
    } else {
        $erro = 'Usuário ou senha inválidos!';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Login Para Cadastro de Novos Personagens</h2>

        <?php if ($erro): ?>
            <div class="alert alert-danger text-center"><?= $erro ?></div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary text-white">
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" id="senha" class="form-control" required>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-success">Entrar</button>
                            </div>

                            <div class="d-grid">
                                <a href="index.php" class="btn btn-primary">Ver catálogo sem Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

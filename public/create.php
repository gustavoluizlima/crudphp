<?php
session_start();
require_once '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Valida os campos
    if (!empty($nome) && !empty($email)) {
        // Insere o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success'>✅ Usuário criado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>❌ Erro: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>❌ Todos os campos são obrigatórios!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <h2 class="text-center mb-4">Criar Novo Usuário</h2>

        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Criar Usuário</button>
        </form>

        <div class="text-center mt-3">
            <a href="index.php">Voltar à lista de usuários</a>
        </div>
    </div>
</body>
</html>

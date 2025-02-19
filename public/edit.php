<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "❌ Usuário não encontrado!";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if (!empty($nome) && !empty($email)) {

        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "✅ Usuário atualizado com sucesso!";
        } else {
            echo "❌ Erro: " . $conn->error;
        }
    } else {
        echo "❌ Todos os campos são obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h2>Editar Usuário</h2>

    <form method="POST" action="edit.php?id=<?php echo $id; ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $user['nome']; ?>" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

        <button type="submit">Atualizar Usuário</button>
    </form>

    <br>
    <a href="index.php">Voltar para a lista</a>
</body>

</html>
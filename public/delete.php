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
        $sql = "DELETE FROM usuarios WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "✅ Usuário excluído com sucesso!";
        } else {
            echo "❌ Erro: " . $conn->error;
        }
    } else {
        echo "❌ Usuário não encontrado!";
    }
} else {
    echo "❌ ID não especificado!";
}
?>

<br>
<a href="index.php">Voltar para a lista</a>
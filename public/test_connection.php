<?php 
require_once '../config/database.php';

if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Erro na conexão: " . $conn->connect_error;
}
?>
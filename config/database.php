<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'crud_php';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
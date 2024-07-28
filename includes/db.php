<?php
$dsn = 'mysql:host=localhost;dbname=LibreriaLis01;charset=utf8';
$username = 'root';
$password = '12345Abc@';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}
?>

<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'empleados';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}
?>
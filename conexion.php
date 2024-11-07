<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "prueba_gestion"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

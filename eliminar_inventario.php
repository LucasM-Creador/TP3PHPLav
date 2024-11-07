<?php
require 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para eliminar el registro
    $sql = "DELETE FROM inventario WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redireccionar de vuelta a inventario.php
    header("Location: inventario.php");
}
?>
<?php
// Conexión a la base de datos
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "prueba_gestion"; 


$conn = new mysqli($servername, $username, $password, $database);

// Verifica conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar qué formulario se ha enviado
$form_type = $_POST['form_type'];


if ($form_type === 'producto') {
    // Procesar formulario de producto
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $codigo = $_POST['codigo'];
    $id_proveedor = $_POST['id_proveedor'];
    $stock = $_POST['stock'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];

    // Manejo del archivo de imagen
    $imagen = null;
    if ($_FILES['imagen']['name']) {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
    }

    // Sentencia SQL para productos
    $sql = "INSERT INTO inventario (nombre, descripcion, marca, codigo, id_proveedor, stock, precio_compra, precio_venta, imagen)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisiddb", $nombre, $descripcion, $marca, $codigo, $id_proveedor, $stock, $precio_compra, $precio_venta, $imagen);

    if ($stmt->execute()) {
        header('inventario.php');
    } else {
        echo "Error al guardar el producto: " . $stmt->error;
    }

}

?>
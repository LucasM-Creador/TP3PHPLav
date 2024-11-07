<?php include('head.php')?> 
<?php include('navbar.php')?> 

<?php require 'conexion.php';
//Para buscar los errores del codigo
error_reporting(E_ALL);
ini_set('display_errors', 1);
?> 


<div class="container">
    <div class="row mt-4">
        <h2 class="text-center">Inventario</h2>
    </div>
    <br>
    <br>
    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addElementModal">
        Añadir Inventario
    </button>

    <br><br>

    <div class="row">
        <table class="table table-bordered ms-4">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">nombre</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">marca</th>
                    <th scope="col">codigo</th>
                    <th scope="col">proveedor</th>
                    <th scope="col">stock</th>
                    <th scope="col">precio de compra</th>
                    <th scope="col">precio de venta</th>
                    <th scope="col">imagen</th>
                    <th scope="col">acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT * FROM inventario";
                $result = $conn->query($sql);

                if (!$result) {
                    echo "Error en la consulta: " . $conn->error;
                } elseif ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . (isset($row['nombre']) ? $row['nombre'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['descripcion']) ? $row['descripcion'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['marca']) ? $row['marca'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['codigo']) ? $row['codigo'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['proveedor']) ? $row['proveedor'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['stock']) ? $row['stock'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['precio_compra']) ? $row['precio_compra'] : 'N/A') . "</td>";
                        echo "<td>" . (isset($row['precio_venta']) ? $row['precio_venta'] : 'N/A') . "</td>";
                        echo "<td><img src='imagenes/" . $row['imagen'] . "' alt='Imagen' width='50'></td>";
                        echo "<td>
                                <a href='editar_inventario.php?id=" . $row['id'] . "' class='btn btn-warning'>Editar</a>
                                <a href='eliminar_inventario.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este registro?\");'>Eliminar</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No hay registros disponibles.</td></tr>";
                }
            ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="addElementModal" tabindex="-1" aria-labelledby="addElementModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addElementModalLabel">Añadir Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para añadir producto -->
                    <form id="addProductForm" method="POST" action="procesar.php" enctype="multipart/form-data">
                        <!-- Campo oculto para indicar que es un producto -->
                        <input type="hidden" name="form_type" value="producto">
                        
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" maxlength="250"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="marca" name="marca" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código</label>
                            <input type="number" class="form-control" id="codigo" name="codigo" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_proveedor" class="form-label">ID del Proveedor</label>
                            <input type="number" class="form-control" id="id_proveedor" name="id_proveedor" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra</label>
                            <input type="number" class="form-control" id="precio_compra" name="precio_compra" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" class="form-control" id="precio_venta" name="precio_venta" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen del Producto</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    
<?php include('fother.php')?> 
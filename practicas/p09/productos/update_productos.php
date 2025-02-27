<?php 
    // Conectar a la base de datos 
    $link = new mysqli('localhost', 'root', 'jojoyrl8', 'marketzone'); 

    // Verificar la conexión 
    if($link->connect_errno){
        die("No fue posible establecer conexión con la base de datos. " . $link->connect_error);
    }

    // Verificar el envío del ID 
    if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
        die("ID de producto no válido");
    }

    $id = intval($_POST['id']); // Convertir a número entero para mayor seguridad
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $detalles = $_POST['descripcion']; // Asegúrate de que este campo sea correcto
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];

    // Manejo de imagen 
    if(!empty($_FILES['imagen']['name'])){
        $imagen = 'img/'.basename($_FILES['imagen']['name']); 
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    } else {
        $imagen = $_POST['imagen_defecto']; 
    }

    // Consulta de actualización 
    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, detalles = ?, precio = ?, unidades = ?, imagen = ? WHERE id = ?";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssssdisi", $nombre, $marca, $modelo, $detalles, $precio, $unidades, $imagen, $id); 

    // Ejecutar actualización 
    if($stmt->execute()){
        echo "<p>Producto actualizado exitosamente</p>"; 
    } else {
        die("No fue posible actualizar el producto: " . $stmt->error); 
    }

    $stmt->close(); 
    $link->close(); 

    echo '<a href="get_productos_xhtml_v2.php">Ver productos en XHTML</a> | ';
    echo '<a href="get_productos_vigentes_v2.php">Ver productos vigentes</a>';
?>

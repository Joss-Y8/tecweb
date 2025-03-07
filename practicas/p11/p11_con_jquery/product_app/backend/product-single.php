<?php
    /*include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];  // Usamos POST en vez de GET
        // SE REALIZA LA QUERY DE BÚSQUEDA POR ID
        $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
        if ( $result = $conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows) && count($rows) > 0) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);*/


include_once __DIR__.'/database.php';

// Crear el arreglo de respuesta
$data = array();

// Verificar si se recibió el ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];  // Usamos POST en vez de GET

    // Usar Prepared Statement para evitar inyecciones SQL
    $sql = "SELECT * FROM productos WHERE id = ? AND eliminado = 0";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("i", $id);  // Bind para el ID como entero
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            // Codificar los datos a UTF-8 y preparar el arreglo de respuesta
            foreach ($rows as $num => $row) {
                foreach ($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }

            echo json_encode($data, JSON_PRETTY_PRINT);  // Retornar los datos en formato JSON
        } else {
            echo json_encode(["status" => "error", "message" => "Producto no encontrado."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error al preparar la consulta."]);
    }

    $conexion->close();
} else {
    echo json_encode(["status" => "error", "message" => "ID no proporcionado."]);
}


?>

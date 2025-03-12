<?php
        
    include_once __DIR__.'/database.php';

    $data = array();

    // Verificar si se recibió el ID
    if (isset($_POST['id'])) {
        $id = $_POST['id'];  

        $sql = "SELECT * FROM productos WHERE id = ? AND eliminado = 0";
        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("i", $id);  
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si se encontraron resultados
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); 

                // Codificar los datos a UTF-8
                foreach ($row as $key => $value) {
                    $data[$key] = utf8_encode($value); 
                }

                // Retornar el producto en formato JSON
                echo json_encode($data, JSON_PRETTY_PRINT);
            } else {
                // Si no se encuentra el producto, simplemente retornamos un JSON vacío
                echo json_encode([]);
            }

            $stmt->close();
        } else {
            // Si hay error al preparar la consulta, retornamos un JSON vacío
            echo json_encode([]);
        }
        $conexion->close();
    } else {
        // Si no se recibe el ID, simplemente retornamos un JSON vacío
        echo json_encode([]);
    }
?>
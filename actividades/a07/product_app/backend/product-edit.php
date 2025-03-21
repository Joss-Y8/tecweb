<?php
    include_once __DIR__ . '/database.php';

    // Capturar datos JSON enviados desde el frontend
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    // Verificar que se recibieron los datos necesarios
    if (!isset($data['id'], $data['nombre'], $data['precio'], $data['unidades'], $data['modelo'], $data['marca'], $data['detalles'], $data['imagen'])) {
        echo json_encode(["status" => "error", "message" => "Datos incompletos o inválidos."]);
        exit;
    }

    // Extraer datos del array
    $id = $data['id'];
    $nombre = $data['nombre'];
    $precio = $data['precio'];
    $unidades = $data['unidades'];
    $modelo = $data['modelo'];
    $marca = $data['marca'];
    $detalles = $data['detalles'];
    $imagen = $data['imagen'];

    // Preparar la consulta para actualizar el producto
    $sql = "UPDATE productos SET nombre = ?, precio = ?, unidades = ?, modelo = ?, marca = ?, detalles = ?, imagen = ? WHERE id = ?";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param('sdissssi', $nombre, $precio, $unidades, $modelo, $marca, $detalles, $imagen, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(["status" => "success", "message" => "Producto actualizado correctamente."]);
            } else {
                echo json_encode(["status" => "error", "message" => "No se actualizó el producto. Verifica el ID o los datos."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Error al ejecutar la consulta: " . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error preparando la consulta: " . $conexion->error]);
    }

    $conexion->close();
?>




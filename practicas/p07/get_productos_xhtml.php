<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>PRODUCTOS</h3>
    <br>
    <?php
    if (isset($_GET['tope'])) {
        $tope = $_GET['tope'];
    } else {
        die('<p>Error: Falta el parámetro "tope" en la URL.</p>');
    }

    if (!empty($tope)) {
        /** Conexión a la base de datos */
        @$link = new mysqli('localhost', 'root', 'jojoyrl8', 'marketzone');

        /** Verificar conexión */
        if ($link->connect_errno) {
            die('<p>Error de conexión: ' . $link->connect_error . '</p>');
        }

        /** Consulta SQL */
        if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
            echo '<table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                            <th>Detalles</th>
                            <th>Imagen</th>
                        </tr>
                    </thead>
                    <tbody>';

            /** Iterar sobre los productos obtenidos */
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <th>' . $row['id'] . '</th>
                        <td>' . htmlspecialchars($row['nombre']) . '</td>
                        <td>' . htmlspecialchars($row['marca']) . '</td>
                        <td>' . htmlspecialchars($row['modelo']) . '</td>
                        <td>' . $row['precio'] . '</td>
                        <td>' . $row['unidades'] . '</td>
                        <td>' . htmlspecialchars($row['detalles']) . '</td>
                        <td><img src="' . htmlspecialchars($row['imagen']) . '" width="100"/></td>
                    </tr>';
            }

            echo '</tbody></table>';

            /** Liberar resultados */
            $result->free();
        } else {
            echo '<p>Error en la consulta.</p>';
        }

        /** Cerrar conexión */
        $link->close();
    }
    ?>
</body> 
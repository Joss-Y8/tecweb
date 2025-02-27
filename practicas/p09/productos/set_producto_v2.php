<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro Completado</title>
		<style type="text/css">
			body {
                /*margin: 40px;*/
                background-color: #f2f2f2;
                font-family: Verdana, Helvetica, sans-serif;
                /*font-size: 90%;*/
                color: #333;
                font-size:  90%;
                line-height: 1.2;
            }
            h1 {
                color: #283593;
                border-bottom: 2px solid #005825;
            }
            h2 {
                font-size: 1.2em;
                color: #4A0048;
                border-bottom: 1px solid #ddd;
                padding-bottom: 3px;
            }
            p {
                font-size: 1.1em;
                margin-bottom: 20px;
            }
            ul {
                background: white;
                padding: 15px;
                border-radius: 10px;
                box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
                list-style-type: none;
            }
            ul li {
                padding: 8px 0;
                border-bottom: 1px solid #eee;
            }
            strong {
                color: #283593;
            }
		</style>
	</head>
    <body>
        <?php
            $nombre = $_POST['nombre'];
            $marca  = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $precio = $_POST['precio'];
            $detalles = $_POST['descripcion'];
            $unidades = $_POST['unidades'];
            //$imagen = 'img/'.$_POST['imagen'];
            $imagen = "img/imagen.png"; // Imagen por defecto

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $imagen = "img/" . basename($_FILES['imagen']['name']);
                move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
            }

            if($nombre === '' || $marca === '' || $modelo ==="" || $detalles ===''){
                die("<h2>Inserta la información en los campos vacíos");
            }

            /** SE CREA EL OBJETO DE CONEXION */
            @$link = new mysqli('localhost', 'root', 'jojoyrl8', 'marketzone');	

            /** comprobar la conexión */
            if ($link->connect_errno) 
            {
                die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
            }

            $sql_check = "SELECT id FROM productos WHERE nombre = ? and marca = ? and modelo = ?";
            $stm_check = $link->prepare($sql_check); 
            $stm_check->bind_param("sss", $nombre, $marca, $modelo); 
            $stm_check->execute(); 
            $stm_check->store_result(); 
            if ($stm_check->num_rows > 0) {
                die("<h1>Error. La base de datos ya contiene un producto con el nombre $nombre de la marca $marca.</h1>");
            }
            $stm_check->close();

            /** Crear una tabla que no devuelve un conjunto de resultados */
            //$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
            //Utilizando column names 
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                    VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

            if ( $link->query($sql) ) 
            {
                echo '<p>Producto insertado con ID: '.$link->insert_id.'</p>';
            }
            else
            {
                echo '<p>El Producto no pudo ser insertado =(</p>';
            }

            $link->close();
        ?>
        <h1>INFORMACIÓN DE REGISTRO</h1>

        <p>Gracias por realizar el registro, en seguida se muestran los datos que han sido capturados</p>

        <h2>Descripción del producto</h2>
        <ul>
            <li><strong>Nombre del producto:</strong> <em><?php echo $_POST['nombre']; ?></em></li>
            <li><strong>Marca del producto:</strong> <em><?php echo $_POST['marca']; ?></em></li>
            <li><strong>Modelo del producto:</strong> <em><?php echo $_POST['modelo']; ?></em></li>
            <li><strong>Detalles del producto:</strong> <em><?php echo $_POST['descripcion']; ?></em></li>
        </ul>
        <h2>Costos</h2>
        <ul>
            <li><strong>Precio del producto:</strong> <em><?php echo $_POST['precio']; ?></em></li>
            <li><strong>Unidades en existencia:</strong> <em><?php echo $_POST['unidades']; ?></em></li>
        </ul>

        <h2>Visuales</h2>
        <ul>
            <li><strong>Imagen descriptiva del producto:</strong> 
                <br/><img src="<?php echo htmlspecialchars($imagen); ?>" alt="Imagen del producto" width="200"/>
            </li>
        </ul>
    </body>
</html>

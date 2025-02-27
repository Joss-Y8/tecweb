<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro productos</title>
    
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
            
    </style>
</head>
<body>
    <?php
        $product = null;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        
            @$link = new mysqli('localhost', 'root', 'jojoyrl8', 'marketzone');
            if ($link->connect_errno) {
                die('Falló la conexión: '.$link->connect_error);
            }
        
            // Obtener los datos del producto
            $stmt = $link->prepare("SELECT * FROM productos WHERE id = ? AND eliminado = 0");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
        
            $stmt->close();
            $link->close();
        }

        if (!$product) {
            header("Location: get_productos_vigentes_v2.php?error=ProductoNoEncontrado");
            exit();
        }
    ?>
    <h1>Registro de nuevos productos en marketzone</h1>
    <form id="formularioProductos" action="http://localhost/tecweb/practicas/p09/productos/set_producto_v2.php" method="post" enctype="multipart/form-data"> 
        <fieldset><legend><h2>Descripción del producto</h2></legend>
            <ul>
                <li><label for="form-nombre">Nombre del producto:</label> <input type="text" name="nombre" id="form-nombre" value="<?= isset($product) ? $product['nombre'] : ''?>"><div id="error1" style="color: red;"></div></li>
                <li>
                    <label for="form-marca">Marca del producto:</label> 
                    <select name="marca" id="form-marca">
                        <option value="">Seleccione una marca</option>
                        <option value="Fender" <?= isset($product) && $product['marca'] == 'Fender' ? 'selected' : '' ?>>Fender</option>
                        <option value="Gibson" <?= isset($product) && $product['marca'] == 'Gibson' ? 'selected' : '' ?>>Gibson</option>
                        <option value="Yamaha" <?= isset($product) && $product['marca'] == 'Yamaha' ? 'selected' : '' ?>>Yamaha</option>
                        <option value="Roland" <?= isset($product) && $product['marca'] == 'Roland' ? 'selected' : '' ?>>Roland</option>
                        <option value="Ibanez" <?= isset($product) && $product['marca'] == 'Ibanez' ? 'selected' : '' ?>>Ibanez</option>
                        <option value="Casio" <?= isset($product) && $product['marca'] == 'Casio' ? 'selected' : '' ?>>Casio</option>
                        <option value="Casio" <?= isset($product) && $product['marca'] == 'Korg' ? 'selected' : '' ?>>Korg</option>
                    </select><div id="error2" style="color: red;"></div>
                </li>
                <li><label for="form-modelo">Modelo del producto:</label> <input type="text" name="modelo" id="form-modelo" value="<?= isset($product) ? $product['modelo'] : '' ?>"><div id="error3" style="color: red;"></div></li>
                <li><label for="form-descripcion">Descripción del producto</label><br><textarea name="descripcion" rows="4" cols="60" id="form-descripcion"> <?= isset($product) ? $product['detalles'] : '' ?></textarea><div id="error4" style="color: red;"></div></li>
            </ul>
        </fieldset>
        <fieldset><legend><h2>Costos</h2></legend>
            <ul>
                <li><label for="form-precio">Precio del producto:</label> <input type="number" name="precio" id="form-precio" value="<?= isset($product) ? $product['precio'] : '' ?>" step="any" min="0"><div id="error5" style="color: red;"></div></li>
                <li><label for="form-unidades">Unidades en existencia:</label> <input type="number" name="unidades" id="form-unidades" value="<?= isset($product) ? $product['unidades'] : '' ?>"><div id="error6" style="color: red;"></div></li>
            </ul>
        </fieldset>
        <fieldset><legend><h2>Visuales</h2></legend>
            <ul>
                <li><label for="form-imagen">Imagen del producto:</label> 
                    <input type="file" name="imagen" id="form-imagen" accept="image/*">
                    <input type="hidden" name="imagen_defecto" id="imagen_defecto" value="<?= isset($product) ? $product['imagen'] : 'img/imagen.png' ?>">
                    <?php if (!empty($product['imagen'])): ?>
                        <p>Ruta de la imagen: <?= htmlspecialchars($product['imagen']); ?></p>
                    <?php endif; ?>
                </li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="Modificar producto">
            <input type="reset">
        </p>
        
   </form>
   <script src="./validacion.js"></script>
</body>
</html>
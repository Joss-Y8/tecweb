<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    $data = array();
    @$link = new mysqli('localhost', 'root', 'jojoyrl8', 'marketzone');

    if ($link->connect_errno) {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
    }

    // Consulta sin depender de 'tope'
    $sql = "SELECT * FROM productos WHERE eliminado = 0";

    if ($result = $link->query($sql)) {
        $row = $result->fetch_all(MYSQLI_ASSOC);
        
        foreach ($row as $num => $registro) {
            foreach ($registro as $key => $value) {
                $data[$num][$key] = utf8_encode($value);
            }
        }
        $result->free();
    }

    $link->close();
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Producto</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script>
		function modificarProducto(event) {
			var row = event.target.closest("tr"); 
			var id = row.querySelector(".id").textContent.trim();

			// Redirigir solo con el ID, los demás datos se obtienen en el formulario
			var url = `formulario_productos_v2.php?id=${encodeURIComponent(id)}`;
			window.location.href = url;
		}
	</script>

</head>
<body>
	<h3>PRODUCTOS DISPONIBLES</h3>
	<br/>
	<?php if(isset($row) && count($row) > 0) : ?>
		<table class="table">
			<thead class="thead-dark">
				<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
				<th scope="col">Marca</th>
				<th scope="col">Modelo</th>
				<th scope="col">Precio</th>
				<th scope="col">Unidades</th>
				<th scope="col">Detalles</th>
				<th scope="col">Imagen</th>
				<th scope="col">Modificar</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $value) : ?>
				<tr>
					<th class="id" scope="row"><?= $value['id'] ?></th>
					<td class="nombre"><?= $value['nombre'] ?></td>
					<td class="marca"><?= $value['marca'] ?></td>
					<td class="modelo"><?= $value['modelo'] ?></td>
					<td class="precio"><?= $value['precio'] ?></td>
					<td class="unidades"><?= $value['unidades'] ?></td>
					<td class="detalles"><?= $value['detalles'] ?></td>
					<td><img class="imagen" src="<?=$value['imagen'] ?>" width="100"></td>
					<td>
						<button type="button" class="btn btn-warning" onclick="modificarProducto(event)">Modificar</button>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php elseif(!empty($id)) : ?>
		 <script>
            alert('El ID del producto no existe');
         </script>
	<?php else : ?>
		<p>No hay productos disponibles.</p>
	<?php endif; ?>
</body>
</html>
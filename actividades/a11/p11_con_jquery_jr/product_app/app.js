var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function () {

    let edit = false;
    console.log('jQuery is Working');
    listarProductos(); // Listar productos al cargar la página

    // Función para listar productos
    function listarProductos() {
        $.get("./backend/product-list.php", function (data) {
            let productos = JSON.parse(data);
            let template = "";
            productos.forEach(producto => {
                let descripcion = `
                    <li>precio: ${producto.precio}</li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles}</li>
                `;
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });
            $("#products").html(template);
        });
    }

    // Función de búsqueda de productos
    $("#search").on("input", function () {
        let search = $(this).val();
        $.get("./backend/product-search.php", { search: search }, function (data) {
            let productos = JSON.parse(data);
            let template = "", template_bar = "";
            productos.forEach(producto => {
                let descripcion = `
                    <li>precio: ${producto.precio}</li>
                    <li>unidades: ${producto.unidades}</li>
                    <li>modelo: ${producto.modelo}</li>
                    <li>marca: ${producto.marca}</li>
                    <li>detalles: ${producto.detalles}</li>
                `;
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class="product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
                template_bar += `<li>${producto.nombre}</li>`;
            });
            $("#container").html(template_bar);
            $("#products").html(template);
            $("#product-result").addClass("d-block");
        });
    });

    // Formulario de producto
    $("#product-form").submit(function (e) {
        e.preventDefault();
        let productoJsonString = $("#description").val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $("#name").val();
        finalJSON['id'] = $("#productId").val(); // Agregar el ID del producto al JSON

        // Validaciones
        let mensajeError = "";
        if (!finalJSON['nombre'].trim() || finalJSON['nombre'].length > 100) {
            mensajeError = "El nombre del producto es obligatorio y debe tener menos de 100 caracteres.";
        } else if (finalJSON['marca'].length > 25) {
            mensajeError = "La marca no debe exceder los 25 caracteres.";
        } else if (finalJSON['modelo'].length > 25) {
            mensajeError = "El modelo no debe exceder los 25 caracteres.";
        } else if (finalJSON['detalles'].length > 250) {
            mensajeError = "La descripción no debe exceder los 250 caracteres.";
        } else if (finalJSON['precio'] <= 0) {
            mensajeError = "El precio debe ser mayor a 0.";
        } else if (finalJSON['unidades'] < 1) {
            mensajeError = "Debe haber al menos una unidad.";
        }

        if (mensajeError) {
            $("#container").html(`<li style="list-style: none;">${mensajeError}</li>`);
            $("#product-result").addClass("d-block");
            return;
        }

        // Si es una edición, cambia la URL
        let url = edit ? "./backend/product-edit.php" : "./backend/product-add.php";  // Dependiendo si es edición o no
        $.ajax({
            url: url,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(finalJSON),
            success: function (response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#container").html(template_bar);
                $("#product-result").addClass("d-block");

                $('#product-form').trigger('reset');
                $("#description").val(JSON.stringify(baseJSON, null, 2));

                listarProductos();
            }
        });
    });

    // Eliminar producto
    $(document).on("click", ".product-delete", function () {
        if (confirm("¿De verdad deseas eliminar el Producto?")) {
            let id = $(this).closest("tr").attr("productId");
            $.get("./backend/product-delete.php", { id: id }, function (response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#container").html(template_bar);
                $("#product-result").addClass("d-block");
                listarProductos();
            });
        }
    });

    // Editar producto
    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId'); 

        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            $('#name').val(product[0].nombre); 
            $('#description').val(JSON.stringify({
                precio: product[0].precio,
                unidades: product[0].unidades,
                modelo: product[0].modelo,
                marca: product[0].marca,
                detalles: product[0].detalles,
                imagen: product[0].imagen
            }, null, 2));

            // Guardar el ID en el campo oculto
            $("#productId").val(id);
            edit = true; // Indicar que estamos en modo edición
            // Cambiar el texto del botón a "Editar Producto"
            $("#submit-btn").text("Editar Producto");

            
        });
    });

    init();
});

function init() {
    $("#description").val(JSON.stringify(baseJSON, null, 2));
}

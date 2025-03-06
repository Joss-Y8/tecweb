

/*// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    /*var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}



$(document).ready(function(){
    console.log('jQuery is Working'); 
    listarProductos();
    // Buscar productos en tiempo real
    $('#search').on('keyup', function(){
        let search = $('#search').val();
        $.ajax({
            url: 'backend/product-search.php',
            type: 'GET',
            data: { search },
            success: function(response){
                mostrarProductos(response);
            } 
        });
    });

    // Agregar producto
    $('#product-form').submit(function(e){
        e.preventDefault();
        let productoJsonString = $('#description').val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();

        $.ajax({
            url: 'backend/product-add.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(finalJSON),
            success: function(response){
                mostrarMensaje(response);
                listarProductos();
            }
        });
    });

    // Eliminar producto
    $(document).on('click', '.product-delete', function(){
        if(confirm("¿De verdad deseas eliminar el Producto?")) {
            let id = $(this).closest('tr').attr('productId');
            $.ajax({
                url: 'backend/product-delete.php',
                type: 'GET',
                data: { id },
                success: function(response){
                    mostrarMensaje(response);
                    listarProductos();
                }
            });
        }
    });

    function listarProductos(){
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function(response){
                mostrarProductos(response);
            }
        });
    }

    function mostrarProductos(response) {
        let productos = JSON.parse(response);
        let template = '';
        let template_bar = '';
        
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
                    <td>${producto.nombre}</td>
                    <td><ul>${descripcion}</ul></td>
                    <td>
                        <button class="product-delete btn btn-danger">Eliminar</button>
                    </td>
                </tr>
            `;
            template_bar += `<li>${producto.nombre}</li>`;
        });
        
        $('#products').html(template);
        $('#product-result').removeClass('d-none');
        $('#container').html(template_bar);
    }

    function mostrarMensaje(response) {
        let respuesta = JSON.parse(response);
        let template_bar = `
            <li style="list-style: none;">status: ${respuesta.status}</li>
            <li style="list-style: none;">message: ${respuesta.message}</li>
        `;
        $('#product-result').removeClass('d-none');
        $('#container').html(template_bar);
    }
});*/

$(document).ready(function () {
    var baseJSON = {
        "precio": 0.0,
        "unidades": 1,
        "modelo": "XX-000",
        "marca": "NA",
        "detalles": "NA",
        "imagen": "img/default.png"
    };

    function init() {
        $("#description").val(JSON.stringify(baseJSON, null, 2));
        listarProductos();
    }

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
                        <td>${producto.nombre}</td>
                        <td><ul>${descripcion}</ul></td>
                        <td><button class="product-delete btn btn-danger">Eliminar</button></td>
                    </tr>
                `;
            });
            $("#products").html(template);
        });
    }

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
                        <td>${producto.nombre}</td>
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

    $("#product-form").submit(function (e) {
        e.preventDefault();
        let productoJsonString = $("#description").val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $("#name").val();

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

        $.ajax({
            url: "./backend/product-add.php",
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
                listarProductos();
            }
        });
    });

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

    init();
});

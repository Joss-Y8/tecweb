var form=document.getElementById("formularioProductos"); 
var mensaje1='', mensaje2='', mensaje3='', mensaje4='', mensaje5='', mensaje6='', mensaje7=''; 

function validar_nombre(){
    let entrada = document.getElementById("form-nombre").value;
    let sinErrores = true; 
    if(entrada.trim()==="" || entrada.length > 100){
        mensaje1 = "El campo de nombre no puede estar vacío y debe tener máximo 100 caracteres."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

function validar_marca(){
    let entrada = document.getElementById("form-marca").value; 
    let sinErrores = true; 
    if(entrada === ""){
        mensaje2 = "Debes seleccionar una marca."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

function validar_modelo(){
    let entrada = document.getElementById("form-modelo").value; 
    let sinErrores = true; 
    if(entrada.trim() === "" || entrada.length > 25){ 
        mensaje3 = "El modelo es requerido y debe tener 25 caracteres como máximo."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

function validar_detalles(){
    let entrada = document.getElementById("form-descripcion").value; 
    let sinErrores = true; 
    if(entrada.length > 250){ 
        mensaje6 = "La descripción no puede exceder los 250 caracteres."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

function validar_precio(){
    let entrada = parseFloat(document.getElementById("form-precio").value);
    let sinErrores = true; 
    if(isNaN(entrada) || entrada <= 99.99){ 
        mensaje4 = "El precio debe ser mayor a 99.99."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

function validar_unidades(){
    let entrada = document.getElementById("form-unidades").value.trim(); 
    let sinErrores = true; 
    if(entrada === "" || entrada < 0 || isNaN(entrada)){
        mensaje5 = "Las unidades deben ser un número mayor o igual a 0."; 
        sinErrores = false; 
    }
    return sinErrores; 
}

document.getElementById("form-nombre").onfocus = function() {
    document.getElementById("error1").innerHTML = "Por favor ingresa el nombre correcto.";
};
document.getElementById("form-nombre").onblur = function() {
    if (!validar_nombre()) {
        document.getElementById("error1").innerHTML = '<span>' + mensaje1 + '</span>';
    } else {
        document.getElementById("error1").innerHTML = '';
    }
};

document.getElementById("form-marca").onfocus = function() {
    document.getElementById("error2").innerHTML = "Por favor selecciona una marca.";
};
document.getElementById("form-marca").onblur = function() {
    if (!validar_marca()) {
        document.getElementById("error2").innerHTML = '<span>' + mensaje2 + '</span>';
    } else {
        document.getElementById("error2").innerHTML = '';
    }
};

document.getElementById("form-modelo").onfocus = function() {
    document.getElementById("error3").innerHTML = "Por favor ingresa un modelo.";
};
document.getElementById("form-modelo").onblur = function() {
    if (!validar_modelo()) {
        document.getElementById("error3").innerHTML = '<span>' + mensaje3 + '</span>';
    } else {
        document.getElementById("error3").innerHTML = '';
    }
};

document.getElementById("form-descripcion").onfocus = function() {
    document.getElementById("error4").innerHTML = "Si lo consideras conveniente, registra los detalles.";
};
document.getElementById("form-descripcion").onblur = function() {
    if (!validar_detalles()) {
        document.getElementById("error4").innerHTML = '<span>' + mensaje6 + '</span>';
    } else {
        document.getElementById("error4").innerHTML = '';
    }
};

document.getElementById("form-precio").onfocus = function() {
    document.getElementById("error5").innerHTML = "Ingresa el precio del producto en números.";
};

document.getElementById("form-precio").onblur = function() {
    if (!validar_precio()) {
        document.getElementById("error5").innerHTML = '<span>' + mensaje4 + '</span>';
    } else {
        document.getElementById("error5").innerHTML = '';
    }
};

document.getElementById("form-unidades").onfocus = function() {
    document.getElementById("error6").innerHTML = "Especifica cuántas unidades hay disponibles.";
};

document.getElementById("form-unidades").onblur = function() {
    if (!validar_unidades()) {
        document.getElementById("error6").innerHTML = '<span>' + mensaje5 + '</span>';
    } else {
        document.getElementById("error6").innerHTML = '';
    }
};

document.getElementById("formularioProductos").addEventListener("submit", function(event) {
    let inputImagen = document.getElementById("form-imagen");

    if (inputImagen.files.length === 0) {  
        document.getElementById("imagen_defecto").disabled = false; // Aseguramos que se envíe
    } else {
        document.getElementById("imagen_defecto").disabled = true;  // No enviamos la imagen por defecto si hay una
    }
});

form.addEventListener('submit', function(event) {
    event.preventDefault();
    let hayErrores = false;

    if( !validar_nombre() ) {
        let div1 = document.getElementById("error1");
        div1.innerHTML = '<span>'+mensaje1+'</span>';
        hayErrores = true;
    }
    if( !validar_marca() ) {
        let div2 = document.getElementById("error2");
        div2.innerHTML = '<span>'+mensaje2+'</span>';
        hayErrores = true;
    }
    if( !validar_modelo() ) {
        let div3 = document.getElementById("error3");
        div3.innerHTML = '<span>'+mensaje3+'</span>';
        hayErrores = true;
    }
    if( !validar_detalles() ) {
        let div4 = document.getElementById("error4");
        div4.innerHTML = '<span>'+mensaje6+'</span>';
        hayErrores = true;
    }
    if(!validar_precio()){
        let div5 = document.getElementById("error5"); 
        div5.innerHTML = '<span>'+mensaje4+'</span>';
        hayErrores = true; 
    }
    if(!validar_unidades()){
        let div6 = document.getElementById("error6"); 
        div6.innerHTML = '<span>'+mensaje5+'</span>';
        hayErrores = true; 
    }


    if(!hayErrores){
        this.submit(); 
    }
});

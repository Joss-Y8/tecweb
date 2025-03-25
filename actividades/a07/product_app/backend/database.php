<?php
    /*$conexion = @mysqli_connect(
        'localhost',
        'root',
        'jojoyrl8',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    /*if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }*/

    use TECWEB\MYAPI\Products as Products; 
    require_once __DIR__.'./myapi/Products.php'; 
    $prodObj = new Products ('marketzone');
    echo json_encode($prodObj->getData());

?>
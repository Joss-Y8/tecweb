<?php
    namespace TECWEB\MYAPI; 

    abstract class DataBase{
        protected $conexion; 

        public function  __construct($db, $user, $pass){
        $this->conexion = @mysqli_connect('localhost', $db, $user, $pass);

            if(!$this->conexion) {
                die('¡Base de datos NO conectada!');
            }
        }
    
    }
?>
<?php
    namespace TECWEB\MYAPI; 

    use TECWEB\MYAPI\DataBase as Database; 
    require_once __DIR__ .'/DataBase.php'; 

    class Products extends DataBase{
        private $data = NULL; 

        public function __construct($db, $user='root', $pass='jojoyrl8'){
            $this->data = array(); 
            parent::__construct($db, $user, $pass); 
        }

        public function delete ($del){

        }

        public function edit (){

        }

        public function list(){
            //CREAMOS EL ARREGLO A DEVOLVERSE EN FORMA JSON
            $this->data=array(); 

            //Query de búsqueda y validación de resultados 
            if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")){

                //obtenemos resultados
                $rows = $result->fetch_all(MYSQLI_ASSOC); 
                if(!is_null($rows)){
                    //codificación a UTF-8 de datos y mapeo al arreglo de respuesta
                    foreach($rows as $num => $row){
                        foreach($row as $key => $value){
                            $this ->data[$num][$key]=utf8_encode($value); 
                        }
                    }
                }
                $result->free(); 
            } else{
                die('Query Error: '.mysqli_error($this->conexion)); 
            }
            $this->conexion->close(); 
        }

        public function search($ser){

        }

        public function single($sin){

        }

        public function singleByName($sib){

        }

        public function getData(){
            return json_encode($this->data, JSON_PRETTY_PRINT); 
        }
    }
?>
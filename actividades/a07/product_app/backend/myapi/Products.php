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

        }

        public function search($ser){

        }

        public function single($sin){

        }

        public function singleByName($sib){

        }

        public function getData(){

        }
    }
?>
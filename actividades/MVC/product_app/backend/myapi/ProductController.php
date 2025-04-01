<?php
namespace TECWEB\MYAPI;

require_once 'ProductModel.php';  
require_once 'ProductView.php';   

class ProductController {
    private $model;
    private $view;

    // Constructor que recibe los parámetros de conexión y crea el modelo
    public function __construct($db, $user ='root', $pass ='jojoyrl8') {
        $this->model = new ProductModel($db, $user, $pass);  
        $this->view = new ProductView();  
    }

     // Mostrar la lista de productos
     public function showProductList() {
        $this->model->list();  
        $products = $this->model->getData();  
        $this->view->renderProductList($products);  
    }

    // Agregar un nuevo producto
    public function addProduct($prod) {
        $this->model->add($prod);  
        $result = $this->model->getData(); 
        $this->view->renderMessage($result); 
    }

    public function editProduct($data) {
        $this->model->edit($data);
        $result = $this->model->getData();
        $this->view->renderMessage($result);
    }

    // Eliminar un producto
    public function deleteProduct($id) {
        $this->model->delete($id);  
        $result = $this->model->getData(); 
        $this->view->renderMessage($result);  
    }

    // Buscar productos
    public function searchProduct($search) {
        $this->model->search($search);  
        $result = $this->model->getData(); 
        $this->view->renderSearchResults($result);  
    }

    // Ver un solo producto por ID
    public function viewProduct($id) {
        $this->model->single($id);  
        $result = $this->model->getData();  
        $this->view->renderSingleProduct($result); 
    }


}
?>



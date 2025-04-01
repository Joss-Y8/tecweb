<?php
namespace TECWEB\MYAPI;

require_once 'ProductModel.php';
require_once 'ProductView.php';

class ProductController {
    private $model;
    private $view;

    public function __construct($db, $user = 'root', $pass = 'jojoyrl8') {
        $this->model = new ProductModel($db, $user, $pass);
        $this->view = new ProductView();
    }

    public function showProductList() {
        $this->model->list();
        $products = $this->model->getData();
        $this->view->renderProductList($products);
    }

    public function addProduct($prod) {
        $result = $this->model->add($prod);

        if ($result === true) {
            $this->view->renderMessage([
                'status' => 'success',
                'message' => 'Producto agregado correctamente.'
            ]);
        } elseif ($result === 'exists') {
            $this->view->renderMessage([
                'status' => 'error',
                'message' => 'Ya existe un producto con ese nombre.'
            ]);
        } else {
            $this->view->renderMessage([
                'status' => 'error',
                'message' => 'Error al agregar el producto.'
            ]);
        }
    }

    public function editProduct($data) {
        $result = $this->model->edit($data);

        $this->view->renderMessage([
            'status' => $result ? 'success' : 'error',
            'message' => $result ? 'Producto actualizado correctamente.' : 'Error al actualizar el producto.'
        ]);
    }

    public function deleteProduct($id) {
        $result = $this->model->delete($id);

        $this->view->renderMessage([
            'status' => $result ? 'success' : 'error',
            'message' => $result ? 'Producto eliminado correctamente.' : 'Error al eliminar el producto.'
        ]);
    }

    public function searchProduct($search) {
        $this->model->search($search);
        $result = $this->model->getData();
        $this->view->renderSearchResults($result);
    }

    public function viewProduct($id) {
        $this->model->single($id);
        $result = $this->model->getData();

        if ($result) {
            $this->view->renderSingleProduct($result);
        } else {
            $this->view->renderMessage([
                'status' => 'error',
                'message' => 'Producto no encontrado.'
            ]);
        }
    }
}
?>




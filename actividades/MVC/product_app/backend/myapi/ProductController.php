<?php
namespace TECWEB\MYAPI;

require_once 'ProductModel.php';  // Incluir el modelo
require_once 'ProductView.php';   // Incluir la vista

class ProductController {
    private $model;
    private $view;

    // Constructor que recibe los parámetros de conexión y crea el modelo
    public function __construct($db, $user ='root', $pass ='jojoyrl8') {
        $this->model = new ProductModel($db, $user, $pass);  // Crear el modelo con la conexión a la base de datos
        $this->view = new ProductView();  // Crear la vista
    }

    // Mostrar la lista de productos
    /*public function showProductList() {
        $this->model->list();  // Llamar al método del modelo para obtener la lista de productos
        $products = $this->model->getData();  // Obtener los datos del modelo
        $this->view->renderProductList($products);  // Pasar los productos a la vista para mostrarlos
    }

    // Agregar un nuevo producto
    /*public function addProduct($prod) {
        $this->model->add($prod);  // Llamar al método del modelo para agregar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }

    // Editar un producto existente
    public function editProduct($data) {
        $this->model->edit($data);  // Llamar al método del modelo para editar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }

    // Eliminar un producto
    public function deleteProduct($id) {
        $this->model->delete($id);  // Llamar al método del modelo para eliminar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }*/

    // Agregar un nuevo producto
/*public function addProduct($prod) {
    $this->model->add($prod);  // Llamar al método del modelo para agregar el producto
    $result = $this->model->getData();  // Obtener los resultados
    // Asegúrate de que $result contenga 'status' y 'message'
    $this->view->renderMessage($result['status'], $result['message']);
}

// Editar un producto existente
public function editProduct($data) {
    $this->model->edit($data);  // Llamar al método del modelo para editar el producto
    $result = $this->model->getData();  // Obtener los resultados
    // Asegúrate de que $result contenga 'status' y 'message'
    $this->view->renderMessage($result['status'], $result['message']);
}

// Eliminar un producto
public function deleteProduct($id) {
    $this->model->delete($id);  // Llamar al método del modelo para eliminar el producto
    $result = $this->model->getData();  // Obtener los resultados
    // Asegúrate de que $result contenga 'status' y 'message'
    $this->view->renderMessage($result['status'], $result['message']);
}*/

/*public function addProduct($prod) {
    $this->model->add($prod);  // Llamar al método del modelo para agregar el producto
    $result = $this->model->getData();  // Obtener los resultados
    // Verificar que el modelo haya devuelto los mensajes correctamente
    $status = $result['status'] ?? 'error';
    $message = $result['message'] ?? 'Error al procesar la solicitud';
    $this->view->renderMessage($status, $message);  // Mostrar el mensaje resultante (success o error)
}

public function editProduct($data) {
    $this->model->edit($data);  // Llamar al método del modelo para editar el producto
    $result = $this->model->getData();  // Obtener los resultados
    $status = $result['status'] ?? 'error';
    $message = $result['message'] ?? 'Error al procesar la solicitud';
    $this->view->renderMessage($status, $message);  // Mostrar el mensaje resultante (success o error)
}

public function deleteProduct($id) {
    $this->model->delete($id);  // Llamar al método del modelo para eliminar el producto
    $result = $this->model->getData();  // Obtener los resultados
    $status = $result['status'] ?? 'error';
    $message = $result['message'] ?? 'Error al procesar la solicitud';
    $this->view->renderMessage($status, $message);  // Mostrar el mensaje resultante (success o error)
}

    // Buscar productos
    public function searchProduct($search) {
        $this->model->search($search);  // Llamar al método del modelo para realizar la búsqueda
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderSearchResults($result);  // Mostrar los resultados de la búsqueda
    }

    // Ver un solo producto por ID
    public function viewProduct($id) {
        $this->model->single($id);  // Llamar al método del modelo para obtener el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderSingleProduct($result);  // Mostrar los detalles del producto
    }*/

     // Mostrar la lista de productos
     public function showProductList() {
        $this->model->list();  // Llamar al método del modelo para obtener la lista de productos
        $products = $this->model->getData();  // Obtener los datos del modelo
        $this->view->renderProductList($products);  // Pasar los productos a la vista para mostrarlos
    }

    // Agregar un nuevo producto
    public function addProduct($prod) {
        $this->model->add($prod);  // Llamar al método del modelo para agregar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }

    // Editar un producto existente
   /* public function editProduct($data) {
        $this->model->edit($data);  // Llamar al método del modelo para editar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }*/
    public function editProduct($data) {
        $this->model->edit($data);
        $result = $this->model->getData();
        $this->view->renderMessage($result);
    }

    // Eliminar un producto
    public function deleteProduct($id) {
        $this->model->delete($id);  // Llamar al método del modelo para eliminar el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderMessage($result);  // Mostrar el mensaje resultante (success o error)
    }

    // Buscar productos
    public function searchProduct($search) {
        $this->model->search($search);  // Llamar al método del modelo para realizar la búsqueda
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderSearchResults($result);  // Mostrar los resultados de la búsqueda
    }

    // Ver un solo producto por ID
    public function viewProduct($id) {
        $this->model->single($id);  // Llamar al método del modelo para obtener el producto
        $result = $this->model->getData();  // Obtener los resultados
        $this->view->renderSingleProduct($result);  // Mostrar los detalles del producto
    }


}
?>



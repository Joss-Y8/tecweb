<?php
namespace TECWEB\MYAPI;

class ProductView {

    // Mostrar lista completa de productos
    public function renderProductList($products) {
        $this->sendJSON($products);
    }

    // Mostrar un solo producto
    public function renderSingleProduct($product) {
        $this->sendJSON($product);
    }

    // Mostrar resultados de búsqueda
    public function renderSearchResults($results) {
        $this->sendJSON($results);
    }

    // Mostrar mensaje de éxito o error
    public function renderMessage($message) {
        $this->sendJSON($message);
    }

    // Método reutilizable para imprimir JSON
    private function sendJSON($data) {
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}




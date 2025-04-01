<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\DataBase as Database;
require_once __DIR__ . '/DataBase.php';

class ProductModel extends Database {
    private $data = null;

    public function __construct($db, $user = 'root', $pass = 'jojoyrl8') {
        $this->data = [];
        parent::__construct($user, $pass, $db);
    }

    public function add($data) {
        if (!isset($data['nombre'])) {
            $this->data = null;
            return false;
        }

        $nombre = $this->conexion->real_escape_string($data['nombre']);

        // Verificar si ya existe
        $sql = "SELECT id FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        if ($result->num_rows > 0) {
            $result->free();
            return 'exists';
        }

        // Insertar nuevo producto
        $sql = sprintf(
            "INSERT INTO productos VALUES (null, '%s', '%s', '%s', %f, '%s', %d, '%s', 0)",
            $nombre,
            $this->conexion->real_escape_string($data['marca']),
            $this->conexion->real_escape_string($data['modelo']),
            $data['precio'],
            $this->conexion->real_escape_string($data['detalles']),
            $data['unidades'],
            $this->conexion->real_escape_string($data['imagen'])
        );

        $result = $this->conexion->query($sql);
        return $result;
    }

    public function edit($data) {
        $this->data = null;

        if (!isset($data['id'])) return false;

        $sql = "UPDATE productos SET nombre = ?, precio = ?, unidades = ?, modelo = ?, marca = ?, detalles = ?, imagen = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);

        if (!$stmt) return false;

        $stmt->bind_param(
            'sdissssi',
            $data['nombre'],
            $data['precio'],
            $data['unidades'],
            $data['modelo'],
            $data['marca'],
            $data['detalles'],
            $data['imagen'],
            $data['id']
        );

        $stmt->execute();
        $affected = $stmt->affected_rows;
        $stmt->close();

        return $affected > 0;
    }

    public function delete($id) {
        $sql = "UPDATE productos SET eliminado = 1 WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param('i', $id);
        $stmt->execute();
        $success = $stmt->affected_rows > 0;
        $stmt->close();

        return $success;
    }

    public function list() {
        $this->data = [];

        $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0");
        if ($result) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }

        return true;
    }

    public function search($searchTerm) {
        $this->data = [];

        $term = $this->conexion->real_escape_string($searchTerm);

        $sql = "SELECT * FROM productos 
                WHERE (id = '{$term}' OR nombre LIKE '%{$term}%' OR marca LIKE '%{$term}%' OR detalles LIKE '%{$term}%') 
                AND eliminado = 0";

        $result = $this->conexion->query($sql);
        if ($result) {
            $this->data = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }

        return true;
    }

    public function single($id) {
        $this->data = [];

        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE id = ? AND eliminado = 0");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        $this->data = $res->fetch_assoc() ?? [];
        $stmt->close();

        return true;
    }

    public function getData() {
        return $this->data;
    }
}
?>


<?php
require_once '../modelo/LibroModel.php';

class LibroController {
    private $model;

    public function __construct() {
        $this->model = new LibroModel();
    }

    public function listarLibros() {
        $libros = $this->model->getAllLibros();
        include 'vistas/paginas/listarLibros.php';
    }

    public function verLibro($id) {
        $libro = $this->model->getLibroById($id);
        include 'vistas/paginas/verLibro.php';
    }
}
?>
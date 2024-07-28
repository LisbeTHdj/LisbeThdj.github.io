<?php
require_once __DIR__ . '/../modelo/AutorModel.php';

class AutorController {
    private $model;

    public function __construct() {
        $this->model = new AutorModel();
    }

    public function listarAutores() {
        $autores = $this->model->getAllAutores();
        include 'vistas/paginas/listarAutores.php';
    }

    public function verAutor($id) {
        $autor = $this->model->getAutorById($id);
        include 'vistas/paginas/verAutor.php';
    }
}
?>
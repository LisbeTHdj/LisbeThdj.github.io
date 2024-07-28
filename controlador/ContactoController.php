<?php
require_once __DIR__ . '/../modelo/ContactoModel.php';

class ContactoController {
    private $model;

    public function __construct() {
        $this->model = new ContactoModel();
    }

    public function listarContactos() {
        $contactos = $this->model->getAllContactos();
        include __DIR__ . '/../vistas/paginas/listarContactos.php';
    }

    public function verContacto($id) {
        $contacto = $this->model->getContactoById($id);
        include __DIR__ . '/../vistas/paginas/verContacto.php';
    }
}
?>

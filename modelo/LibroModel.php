<?php
require_once '../includes/db.php';

class LibroModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAllLibros() {
        $stmt = $this->pdo->prepare("SELECT * FROM titulos");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLibroById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM titulos WHERE id_titulo = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
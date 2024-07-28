<?php
require_once __DIR__ . '/../includes/db.php';

class AutorModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAllAutores() {
        $stmt = $this->pdo->prepare("SELECT * FROM autores");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAutorById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

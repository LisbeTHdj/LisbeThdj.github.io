<?php
require_once __DIR__ . '/../includes/db.php'; // Ruta relativa correcta

class ContactoModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getAllContactos() {
        $stmt = $this->pdo->prepare("SELECT * FROM contacto");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getContactoById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM contacto WHERE id_contacto = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

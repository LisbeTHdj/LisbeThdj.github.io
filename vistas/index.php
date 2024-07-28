<?php
// la visualización de errores en PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// configuración y conexiones
$dsn = 'mysql:host=localhost;dbname=LibreriaLis01;charset=utf8';
$username = 'root';
$password = '12345Abc@';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
}

// Controladores
require_once '../controlador/LibroController.php';
require_once '../controlador/AutorController.php';
require_once '../controlador/ContactoController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// instancias de los controladores
$libroController = new LibroController();
$autorController = new AutorController();
$contactoController = new ContactoController();

// Rutas 
switch ($action) {
    case 'listarLibros':
        $libroController->listarLibros();
        break;
    case 'verLibro':
        if ($id) {
            $libroController->verLibro($id);
        } else {
            echo "ID de libro no proporcionado.";
        }
        break;
    case 'listarAutores':
        $autorController->listarAutores();
        break;
    case 'verAutor':
        if ($id) {
            $autorController->verAutor($id);
        } else {
            echo "ID de autor no proporcionado.";
        }
        break;
    case 'contacto':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactoController->enviarMensaje($_POST);
        } else {
            include 'paginas/contacto.php';
        }
        break;
    default:
        include 'paginas/home.php'; // Página de inicio por defecto
        break;
}
?>

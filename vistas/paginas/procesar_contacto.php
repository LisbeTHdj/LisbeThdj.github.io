<?php
$host = 'localhost'; 
$dbname = 'LibreriaLis01'; 
$user = 'root'; 
$pass = '12345Abc@'; 

$success = false;

// conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Conexión fallida: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    
    $sql = 'CALL InsertarContacto(NOW(), :email, :nombre, :asunto, :mensaje)';
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':asunto' => $asunto,
            ':mensaje' => $mensaje,
        ]);
        
        $success = true;
        
        // Limpiar los campos 
        $_POST = array();
    } catch (PDOException $e) {
        echo 'Error al procesar el formulario: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contacto</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../paginas/img/Logo.png">

    <style>
        /* Estilo personalizado para la barra de navegación */
        .navbar-custom {
            background-color: #9b59b6; 
        }
        .navbar-custom .navbar-brand img {
            height: 30px; 
        }
        .navbar-custom .navbar-nav .nav-link {
            color: #fff; 
        }
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #dcdcdc; 
        }
        .dropdown-menu {
            background-color: #9b59b6; 
        }
        .dropdown-menu .dropdown-item {
            color: #fff; 
        }
        .dropdown-menu .dropdown-item:hover {
            background-color: #8e44ad;
        }
        
        /* Estilo personalizado para el formulario de contacto */
        .contact-form {
            background-color: #f7f7f7;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .contact-form h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="./imagenes/logo_libreria_p.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="home.php" id="homeLink">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Libros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="verLibro.php">Ver todos los libros</a>
                        <a class="dropdown-item" href="verAutor.php">Biografias</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Autores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                        <a class="dropdown-item" href="listarAutores.php">Ver todos los autores</a>
                        <a class="dropdown-item" href="verLibro.php">Derechos</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=contacto">Contacto</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact-form">
                    <h2 class="text-center">Formulario de Contacto</h2>
                    <?php if ($success): ?>
                        <div class="alert alert-success" role="alert">
                            Enviado con éxito
                        </div>
                    <?php endif; ?>
                    <form action="procesar_contacto.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="asunto">Asunto:</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" value="<?php echo isset($_POST['asunto']) ? htmlspecialchars($_POST['asunto']) : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required><?php echo isset($_POST['mensaje']) ? htmlspecialchars($_POST['mensaje']) : ''; ?></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

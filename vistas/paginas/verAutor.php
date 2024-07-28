<?php
// Conexión a la base de datos
$host = 'localhost'; 
$dbname = 'LibreriaLis01'; 
$user = 'root'; 
$pass = '12345Abc@'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Conexión fallida: ' . $e->getMessage();
    exit();
}

// Consulta SQL
$sql = 'SELECT a.nombre AS autor_nombre, t.titulo AS libro_titulo, b.biografia AS biografia
        FROM autores a
        JOIN biografias b ON a.id_autor = b.id_autor
        JOIN titulo_autor ta ON a.id_autor = ta.id_autor
        JOIN titulos t ON ta.id_titulo = t.id_titulo';

$stmt = $pdo->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Autores</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../paginas/img/Logo.png">
    <style>
        /* Estilos personalizados para la barra de navegación */
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
    </style>
</head>
<body>
    <!-- Barra de navegación personalizada -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">
            <img src="Logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="listarAutores.php">Autores</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Más
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="contacto.php">Contacto</a>
                        <a class="dropdown-item" href="listarLibros.php">Libros</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <h1>Autores y Libros</h1>
        <div class="row">
            <?php foreach ($resultado as $row): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['autor_nombre']); ?></h5>
                            <p class="card-text"><strong>Libro:</strong> <?php echo htmlspecialchars($row['libro_titulo']); ?></p>
                            <p class="card-text"><?php echo htmlspecialchars($row['biografia']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

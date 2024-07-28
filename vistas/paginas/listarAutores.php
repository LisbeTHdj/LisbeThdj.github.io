<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Autores</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../paginas/img/Logo.png">
    <style>
        body {
            padding-top: 56px;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-custom {
            background-color: #9b59b6; 
            position: fixed; 
            top: 0;
            left: 0;
            width: 100%; 
            z-index: 1030; 
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
        .table {
            margin: 20px;
        }
        .table th, .table td {
            text-align: center;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <a class="navbar-brand" href="home.php">
    <img src="img/Logo.png" alt="" >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?action=home" id="homeLink">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Libros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="listarLibros.php">Libros</a> 
</div>

                </li>
                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Autores
                    </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="verLibro.php">Derechos</a> <!-- Enlace a la página verLibro.php -->
                    <a class="dropdown-item" href="verAutor.php">Biografías</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="contacto.php">Contacto</a>
</li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Listado de Autores</h1>
        <?php
        // conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "12345Abc@";
        $dbname = "LibreriaLis01";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "
            SELECT a.id_autor, a.nombre, a.apellido, a.telefono, a.direccion, a.ciudad, a.estado, a.pais, a.cod_postal, b.biografia 
            FROM autores a
            LEFT JOIN biografias b ON a.id_autor = b.id_autor
        ";

        $result = $conn->query($sql);

        if (!$result) {
            die("Error al ejecutar la consulta: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>Dirección</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Código Postal</th><th>Biografía</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id_autor"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["apellido"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["telefono"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["direccion"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["ciudad"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["estado"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["pais"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cod_postal"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["biografia"]) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-center'>No se encontraron autores.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- jQuery y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const homeLink = document.getElementById('homeLink');
            if (homeLink) {
                homeLink.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    window.location.href = 'home.php'; 
                });
            }
        });
    </script>
</body>
</html>

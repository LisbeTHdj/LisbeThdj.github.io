<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Libros</title>
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="home.php"><img src="img/Logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="home.php" id="homeLink">Inicio</a>
                <li class="nav-item"><a class="nav-link" href="listarAutores.php" id="autorLink">Autores</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php" id="contactoLink">Contacto</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Más
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="verAutor.php">Biografías</a>
                        <a class="dropdown-item" href="verLibro.php">Derechos</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
    <h1 class="text-center">Listado de Libros</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Publicador ID</th>
                    <th>Precio</th>
                    <th>Avance</th>
                    <th>Total Ventas</th>
                    <th>Notas</th>
                    <th>Fecha Publicación</th>
                    <th>Contrato</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "12345Abc@";
        $dbname = "LibreriaLis01";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $sql = "SELECT id_titulo, titulo, tipo, id_pub, precio, avance, total_ventas, notas, fecha_pub, contrato FROM titulos";
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "<tr><td colspan='10'>Error en la consulta: " . $conn->error . "<br>Consulta: " . $sql . "</td></tr>";
                } else {
                    
                    if ($result->num_rows > 0) {
                       
                        while($row = $result->fetch_assoc()) {
                            
                            echo "<tr>
                                    <td>{$row['id_titulo']}</td>
                                    <td>{$row['titulo']}</td>
                                    <td>{$row['tipo']}</td>
                                    <td>{$row['id_pub']}</td>
                                    <td>{$row['precio']}</td>
                                    <td>{$row['avance']}</td>
                                    <td>{$row['total_ventas']}</td>
                                    <td>{$row['notas']}</td>
                                    <td>{$row['fecha_pub']}</td>
                                    <td>{$row['contrato']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No se encontraron libros</td></tr>";
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!--  Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

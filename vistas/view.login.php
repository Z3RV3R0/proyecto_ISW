<?php
# view.login.php
session_start();  // Iniciar la sesión

// Conexión a la base de datos
include('../conexion.php');

// Inicializar variable para almacenar el nombre del usuario
$nombreUsuario = '';
$rolUsuario = '';

// Verificar si la sesión está activa
if(isset($_SESSION['Correo'])){
    $correo = $_SESSION['Correo'];

    // Preparar y ejecutar la consulta para obtener el nombre y el rol del usuario
    $stmt = $conexion->prepare("SELECT Nombre, Rol FROM usuario WHERE Correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->bind_result($nombreUsuario, $rolUsuario);
    $stmt->fetch();
    $stmt->close();
    $conexion->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Interfaz de Red</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace al archivo CSS personalizado -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Barra de Tareas Superior -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="#">Interfaz de Red</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link">Bienvenido, <?php echo $nombreUsuario; ?> (Rol: <?php echo $rolUsuario; ?>)</span>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <div class="row">
            <!-- Ventana de comandos y configuraciones a la izquierda -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Comandos y Configuraciones</div>
                    <div class="card-body">
                        <textarea id="ventanaComandos" class="form-control" rows="10"></textarea>
                        <button class="btn btn-primary mt-3" onclick="ejecutarComando()">Ejecutar</button>
                    </div>
                </div>
            </div>
            
            <!-- Área de salida a la derecha -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Salida</div>
                    <div class="card-body">
                        <div id="resultado"></div>
                        <!-- Botón de Cerrar Sesión -->
                        <div class="text-right mt-3">
                            <a href="../sesiones/logout.php" class="btn btn-danger">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y jQuery (opcional) si necesitas funcionalidad adicional -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

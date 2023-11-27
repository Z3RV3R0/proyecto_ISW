<?php
header('Content-Type: text/html; charset=utf-8');
require_once '../validaciones/validacion.php';

$Nombre = isset($_POST["Nombre"]) ? $_POST["Nombre"] : NULL;
$Correo = isset($_POST["Correo"]) ? $_POST["Correo"] : NULL;
$Contraseña = isset($_POST["Contraseña"]) ? $_POST["Contraseña"] : NULL;
$errorN = ''; $errorC = ''; $errorP = '';

$errores = array();

if ($_POST) {
    if (empty($Nombre)) {
        $errorN = 'Por favor, ingrese su nombre.';
        $errores[] = $errorN;
    } elseif (!validaName($Nombre)) {
        $errores[] = 'Error al rellenar este campo Nombre.';
    }
    
    if (empty($Correo)) {
        $errorC = 'Por favor, ingrese su correo.';
        $errores[] = $errorC;
    } elseif (!validaCorreo($Correo)) {
        $errores[] = 'Correo incorrecto.';
    }

    if (empty($Contraseña)) {
        $errorP = 'Por favor, ingrese su contraseña.';
        $errores[] = $errorP;
    } elseif (!validaPassword($Contraseña)) {
        $errores[] = 'Error al rellenar el campo Contraseña.';
    }

    if (empty($errores)) {
        include '../conexion.php';

        // Verificar si el correo ya existe en la base de datos
        $correo_repetido = mysqli_query($conexion, "SELECT * FROM usuario WHERE Correo = '$Correo'");
        if (mysqli_num_rows($correo_repetido) > 0) {
            $errores[] = 'Correo ya existente';
        }

        // Verificar si el nombre de usuario ya existe en la base de datos
        $usuario_repetido = mysqli_query($conexion, "SELECT * FROM usuario WHERE Nombre = '$Nombre'");
        if (mysqli_num_rows($usuario_repetido) > 0) {
            $errores[] = 'Nombre de usuario ya existente';
        }

        // Si no hay errores, insertar el usuario
        if (empty($errores)) {
            $insert = "INSERT INTO usuario(Nombre, Correo, Contraseña) VALUES('$Nombre', '$Correo', '$Contraseña')";
            $resultado = mysqli_query($conexion, $insert);

            if (!$resultado) {
                $errores[] = 'Registro fallido';
            } else {
                // Redirige al usuario a index.php después del registro exitoso
                header("location: ../index.php");
                exit(); // Asegúrate de que el script se detenga después de la redirección
            }
        }

        // Mostrar los errores si los hay
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo $error . '<br>';
            }
        }

        mysqli_close($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Regístrate</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        /* Estilo personalizado para los botones */
        .btn-main {
            background-color: #007BFF;
            color: #fff;
        }
        .btn-main:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #545b62;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Regístrate
                </div>
                <div class="card-body">
                    <form action="registro.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" id="Nombre" name="Nombre" placeholder="Ingrese su nombre">
                            <small class="text-danger"><?php echo $errorN; ?></small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="Correo" name="Correo" placeholder="Ingrese su correo">
                            <small class="text-danger"><?php echo $errorC; ?></small>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="Contraseña" name="Contraseña" placeholder="Ingrese su contraseña">
                            <small class="text-danger"><?php echo $errorP; ?></small>
                        </div>
                        <button type="submit" class="btn btn-primary btn-main">Registrar</button>
                    </form>
                    <br>
                    <a href="../index.php" class="btn btn-secondary">Iniciar Sesión</a>
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

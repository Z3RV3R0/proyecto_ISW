<?php
$login = 'proyecto_ing_sw';
$user = 'root';
$contraseña = '';

$conexion = mysqli_connect("localhost", $user, $contraseña, $login);
/* comprobar la conexión */
if ($conexion->connect_errno) {
    printf("Conexión fallida: %s\n", $conexion->connect_error);
    exit();
}

/* comprobar si el servidor sigue vivo */
if ($conexion->ping()) {
    //printf ("¡La conexión está bien!\n");
} else {
    printf ("Error: %s\n", $conexion->error);
}
?>
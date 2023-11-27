<?php
session_start(); // Iniciando sesion
$error=''; // Variable para almacenar el mensaje de error
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "Username or Password is invalid";
}
    else
{
// Define $username y $password
        $username=$_POST['username'];
        echo($username);
        var_dump($username);
        $password=$_POST['password'];
// Estableciendo la conexion a la base de datos
        include('../conexion.php');
 
        $sql = "SELECT Correo, Contraseña FROM usuario WHERE Correo = '" . $username . "' and Contraseña='".$password."';";
        $query=mysqli_query($conexion,$sql);
        $counter=mysqli_num_rows($query);
        if ($counter==1){
		    $_SESSION['Correo']=$username; // Iniciando la sesion
		    header("location: ../vistas/view.login.php"); // Redireccionando a la pagina profile.php
	
	
}       else {
            $error = "El correo electrónico o la contraseña es inválida.";	
}
}
}
?>
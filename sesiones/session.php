<?php
include('../conexion.php');
 
session_start();// Iniciando Sesion
// Guardando la sesion
$user_check=$_SESSION['Correo'];

// SQL Query para completar la informacion del usuario
$ses_sql=mysqli_query($conexion, "SELECT Correo from usuario where Correo='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['Correo'];

if(!isset($login_session)){
mysqli_close($conexion); // Cerrando la conexion
header('Location: ../index.php'); // Redirecciona a la pagina de inicio
}
?>
<?php
function conexion($DB,$usuario,$pass){
    try{
        $conexion = new PDO("mysql:host=localhost;dbname=$DB",$usuario,$pass);
        return $conexion;
    }catch(PDOException $e){
        return false;
    }
}
?>
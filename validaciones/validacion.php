<?php 

/*function validaUsuario($Id_usuario){
   if($Id_usuario == ''){
      return false;
   }else{
      return true;
   }
}*/

function validaCorreo($Correo){
      if(filter_var($Correo, FILTER_VALIDATE_EMAIL) === FALSE){
         return false;
      }
      else{
         return true;
      }
}

 function validaPassword($Contraseña){
    if($Contraseña == ''){
       return false;
    }else{
       return true;
    }
 }

 function validaName($Nombre){
    if($Nombre == ''){
       return false;
    }else{
       return true;
    }
 }

 function validatipo($Tipo_persona){
    if($Tipo_persona == ''){
       return false;
    }else{
       return true;
    }
 }
 ?>
<?php
define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");
 
define("SECURE", FALSE);    // ¡¡¡SOLO PARA DESARROLLAR!!!!

function OpenConnection()  
{  
    try  
    { 
        $mysqli=new mysqli("localhost","root","","dolcerose_bd"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
    
        if(mysqli_connect_errno()){
             echo 'Conexion Fallida : ', mysqli_connect_error();
            exit();
        }
    
        return $mysqli;
    }  

    
    catch(Exception $e)  
    {  
        echo("Error!");  
    }  
}  
//OpenConnection();

?>
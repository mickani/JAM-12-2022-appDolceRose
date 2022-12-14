<?php
session_start(); //Iniciar una nueva sesión o reanudar la existente
/*include_once 'conexion.php';
include_once 'funcs.php';
include_once 'funciones-fechas.php';
include_once 'funciones-varias.php';
global $mysqli;*/

$opcion='';
if(isset($_GET['op'])){ 

    $opcion=$_GET['op'];

require_once 'clases/proveedores.php';
$proveedores=new Proveedores();

switch ($opcion) { 

case 'guardaryeditar':
        
        $idproveedores=$proveedores->setProveedores($_POST['id_proveedor'], $_POST['nombre'], $texto);
        if($idproveedores){
            echo 1;
         }else{
            echo 0;
        }
    break; 

case 'listar':
    
    
    $data=Array();
    ///*************  BUSCAMOS TURNOS 
    $rspta= Proveedores::listar();
    $canFilas=0;
    
    $tr=''; // filas que cntienen las cosultas
    while ($reg=$rspta->fetch_object()) {
      
          $boton='<button type="button" class="btnTl btn-success"  onclick="editar('.$reg->id_proveedor.')">Editar</button>&nbsp;<button type="button" class="btnTl btn-success"  onclick="eliminar('.$reg->id_proveedor.')">Eliminar</button>';
         
      $tr.='<tr id="p_'.$reg->id_proveedor.'"><td >'.$reg->id_proveedor.'</td><td>'.$reg->nombre_proveedor.'</td><td><div  style="align-items: center;">'.$boton.'</div></td></tr>';
     
      
      $canFilas++;
    }
    if($canFilas==0){
        $tr='<tr ><td colspan="3" style="text-align: center !important;">
                    No se encontraron Proveedores cargados
                   </td>
                 </tr>';
    }
   
    $data["canFilas"]=$canFilas;
    $data["filas"]=$tr;
    echo json_encode($data);

break;

case 'eliminar':
    $rspta=$proveedores->eliminar($_POST['id_proveedor']);
    echo $rspta ? 1 : 0;// ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
 
break;






 //default "nada";
}

} // fin de if(!isset($_POST['opcion'])){ 
    else{
      echo "nada----";
  }
?>
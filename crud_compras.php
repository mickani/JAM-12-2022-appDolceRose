<?php
session_start(); //Iniciar una nueva sesión o reanudar la existente

include_once 'funciones-fechas.php';

$opcion='';
if(isset($_GET['op'])){ 

    $opcion=$_GET['op'];

require_once 'clases/compras.php';
$compras=new Compras();

switch ($opcion) { 

case 'guardaryeditar':
        $idcompras=Compras::setCompras($_POST['id_compra'], $_POST['proveedores'], $_POST['fecha'], $texto);
        if($idcompras!='-1'){
            require_once 'clases/detalles_compras.php';
            if (empty($_POST['id_compra'])){
                $rspta=Detalles_compras::setDetalles_compras($idcompras, $_POST['materiasPrimas'], $_POST['cantidad'], $_POST['costo'], $texto);
                if($rspta){
                    require_once 'clases/materias_primas.php';
                     $rspta=Materias_primas::sumarMaterias_primas($_POST['materiasPrimas'], $_POST['cantidad'], $_POST['cantidadResta'], $_POST['costo'], $texto);
                    }
                }
            else{
                $rspta=Detalles_compras::acDetalles_compras($_POST['id_compra'], $_POST['materiasPrimas'],$_POST['id_anteriorMP'], $_POST['cantidad'], $_POST['costo'], $texto);
                if($rspta){
                    require_once 'clases/materias_primas.php';
                     $rspta=Materias_primas::sumarMaterias_primas($_POST['materiasPrimas'], $_POST['cantidad'], $_POST['cantidadResta'], $_POST['costo'], $texto);
                    }
            }
            echo $rspta;// ? 1 : 0;

         }else{
            echo 0;
        }
    break; 

case 'listar':
    
    
    $data=Array();
    ///*************  BUSCAMOS TURNOS 
    $rspta= Compras::listar();
    $canFilas=0;
    
    $tr=''; // filas que cntienen las cosultas
    while ($reg=$rspta->fetch_object()) {
      
          /*$boton='<button type="button" class="btnTl btn-success"  onclick="editar('.$reg->id_proveedor.')">Editar</button>&nbsp;<button type="button" class="btnTl btn-success"  onclick="eliminar('.$reg->id_proveedor.')">Eliminar</button>';*/
          $boton='<a type="button" onclick="editar('.$reg->id_compra.','.$reg->id_mp.')" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a type="button" onclick="eliminar('.$reg->id_compra.','.$reg->id_mp.')" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>';
     $trid=$reg->id_compra."_".$reg->id_mp;// armo el identificador de la fila y sus componentes...
      $tr.='<tr id="c_'.$trid.'"><td >'.$reg->nombre_proveedor.'<input type="hidden" name="pro_'.$trid.'" id="pro_'.$trid.'" value="'.$reg->id_pro.'"></td><td>'.$reg->nombre_materia_prima.'<input type="hidden" name="mp_'.$trid.'" id="mp_'.$trid.'" value="'.$reg->id_mp.'"></td><td>'.$reg->cantidad.'</td><td>'.$reg->costo.'</td><td>'.cfecha($reg->fecha_compra).'<input type="hidden" name="fecha_'.$trid.'" id="fecha_'.$trid.'" value="'.$reg->fecha_compra.'"></td><td><div  style="align-items: center;">'.$boton.'</div></td></tr>';
     
      
      $canFilas++;
    }
    if($canFilas==0){
        $tr='<tr ><td colspan="6" style="text-align: center !important;">
                    No se encontraron Compras cargados
                   </td>
                 </tr>';
    }
   
    $data["canFilas"]=$canFilas;
    $data["filas"]=$tr;
    echo json_encode($data);

break;

case 'eliminar':
    require_once 'clases/detalles_compras.php';
    $rspta=Detalles_compras::eliminar($_POST['id_compra'],  $_POST['id_mp']);
    if($rspta)  //? 1 : 0;
    {
        $rspta=Compras::eliminar($_POST['id_compra']);//cantidadResta
        if($rspta){
            require_once 'clases/materias_primas.php';
            $rspta=Materias_primas::restarMaterias_primas($_POST['id_mp'], $_POST['cantidadResta'], $texto);
            }
    }
    echo $rspta ? 1 : 0;
break;

case 'listarMaterias':
    require_once 'clases/materias_primas.php';
    $rspta=Materias_primas::select('materiasPrimas');
    echo $rspta ;// ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
 
break;

case 'listarProveedores':
    require_once 'clases/proveedores.php';
    $rspta=Proveedores::select('proveedores');
    echo $rspta ;// ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
 
break;






 //default "nada";
}

} // fin de if(!isset($_POST['opcion'])){ 
    else{
      echo "nada----";
  }
?>
<?php 
include_once 'conexion/Conexion.php';
//global $mysqli;
class Materias_primas {
 private $id_materia_prima ;
 private $nombre_materia_prima ;
 private $stock_actual ;
 private $stock_minimo ;
 private $costo ;
 function __construct() {
$this->setId_materia_prima("");
$this->setNombre_materia_prima("");
$this->setStock_actual("");
$this->setStock_minimo("");
$this->setCosto("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM materias_primas WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_materia_prima($row['id_materia_prima']);
$this->setNombre_materia_prima($row['nombre_materia_prima']);
$this->setStock_actual($row['stock_actual']);
$this->setStock_minimo($row['stock_minimo']);
$this->setCosto($row['costo']);
}else{
$this->setId_materia_prima("");
$this->setNombre_materia_prima("");
$this->setStock_actual("");
$this->setStock_minimo("");
$this->setCosto("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
$sql = "SELECT * FROM materias_primas order by id_materia_prima";
$mysqli=OpenConnection();
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
   // $mostrar =  '<select class="form-control select2" name="'.$name.'" id="'.$name.'">';
    $mostrar =  '<option value="-1">Seleccione..</option>';
    $selected='';
    while ($row = $result->fetch_array()){
        if ($valor==$row['id_materia_prima']) 
            $selected='selected'; 
        else $selected='';
        $mostrar .=  '<option '.$selected.' value="'.$row['id_materia_prima'].'">'.$row['nombre_materia_prima'].'</option>';
    }
    /*fin while*/
   // $mostrar .=  '</select>';
}else{    
    $mostrar = "No existen módulos cargados";
}
  return $mostrar;
}
/*fin function select*/
public static function setMaterias_primas($id_materia_prima, $nombre_materia_prima, $stock_actual, $stock_minimo, $costo, &$texto) {
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    if (empty($id)){
        $sql = "INSERT INTO materias_primas (nombre_materia_prima, stock_actual, stock_minimo, costo) VALUES ('$nombre_materia_prima', '$stock_actual', '$stock_minimo', '$costo')";
        $texto = "Se agregó correctamente el nuevo registro";
    }else{
        $sql = "UPDATE materias_primas SET nombre_materia_prima='$nombre_materia_prima', stock_actual='$stock_actual', stock_minimo='$stock_minimo', costo='$costo' WHERE id = $id";
        $texto = "Se actualizaron los datos del registro";
    }
    return $mysqli->query($sql);
}

public static function restarMaterias_primas($id_materia_prima, $cantidadResta, &$texto){
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    $sql="UPDATE materias_primas SET stock_actual = (stock_actual-".$cantidadResta.") WHERE id_materia_prima = $id_materia_prima";
        $texto = "Se actualizaron los datos del registro";
   
    return $mysqli->query($sql);
}
public static function sumarMaterias_primas($id_materia_prima, $cantidad,$cantidadResta, $costo, &$texto) {
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    if(empty($cantidadResta)){
        $sql = "UPDATE materias_primas SET stock_actual=stock_actual+".$cantidad.", costo='$costo' WHERE id_materia_prima = $id_materia_prima";
        $texto = "Se actualizaron los datos del registro";
    }else{
        $sql="UPDATE materias_primas SET stock_actual = (stock_actual-".$cantidadResta.")+".$cantidad.", costo='$costo' WHERE id_materia_prima = $id_materia_prima";
    }
    
    
    return $mysqli->query($sql);
}
public function getId_materia_prima() {
return $this->id_materia_prima;
}
public function setId_materia_prima($id_materia_prima) {
$this->id_materia_prima = $id_materia_prima;
}
public function getNombre_materia_prima() {
return $this->nombre_materia_prima;
}
public function setNombre_materia_prima($nombre_materia_prima) {
$this->nombre_materia_prima = $nombre_materia_prima;
}
public function getStock_actual() {
return $this->stock_actual;
}
public function setStock_actual($stock_actual) {
$this->stock_actual = $stock_actual;
}
public function getStock_minimo() {
return $this->stock_minimo;
}
public function setStock_minimo($stock_minimo) {
$this->stock_minimo = $stock_minimo;
}
public function getCosto() {
return $this->costo;
}
public function setCosto($costo) {
$this->costo = $costo;
}
}




?>
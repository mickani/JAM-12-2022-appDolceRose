<?php 
include_once 'Conexion.php';
global $mysqli;
class Materias_primas_x_productos {
 private $id_producto ;
 private $id_materia_prima ;
 private $cantidad ;
 function __construct() {
$this->setId_producto("");
$this->setId_materia_prima("");
$this->setCantidad("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM materias_primas_x_productos WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_producto($row['id_producto']);
$this->setId_materia_prima($row['id_materia_prima']);
$this->setCantidad($row['cantidad']);
}else{
$this->setId_producto("");
$this->setId_materia_prima("");
$this->setCantidad("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
$sql = "SELECT * FROM materias_primas_x_productos order by id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
    $mostrar =  '<select class="form-control select2" name="'.$name.'" id="'.$name.'">';
    $mostrar .=  '<option value="-1">Seleccione..</option>';
    $selected='';
    while ($row = $result->fetch_array()){
        if ($valor==$row['id']) $selected='selected'
; else $selected='';
        $mostrar .=  '<option '.$selected.' value="'.$row['id'].'">'.$row['nombre'].'</option>';
    }
/*fin while*/
    $mostrar .=  '</select>';
}else{    $mostrar = "No existen módulos cargados";
}return $mostrar;
}
/*fin function select*/
public static function setMaterias_primas_x_productos($id_producto, $id_materia_prima, $cantidad, &$texto) {
$mysqli->query("SET NAMES UTF8");
$info_carga = info_carga();
if (empty($id)){
$sql = "INSERT INTO materias_primas_x_productos (id_materia_prima, cantidad) VALUES ('$id_materia_prima', '$cantidad')";
$texto = "Se agregó correctamente el nuevo registro";
}else{
$sql = "UPDATE materias_primas_x_productos SET id_materia_prima='$id_materia_prima', cantidad='$cantidad' WHERE id = $id";
$texto = "Se actualizaron los datos del registro";
}
return $mysqli->query($sql);
}
public function getId_producto() {
return $this->id_producto;
}
public function setId_producto($id_producto) {
$this->id_producto = $id_producto;
}
public function getId_materia_prima() {
return $this->id_materia_prima;
}
public function setId_materia_prima($id_materia_prima) {
$this->id_materia_prima = $id_materia_prima;
}
public function getCantidad() {
return $this->cantidad;
}
public function setCantidad($cantidad) {
$this->cantidad = $cantidad;
}
}




?>
<?php 
include_once 'Conexion.php';
global $mysqli;
class Elaboracion {
 private $id_elaboracion ;
 private $id_producto ;
 private $cantidad_elaborada ;
 private $costo_unitario_producto ;
 function __construct() {
$this->setId_elaboracion("");
$this->setId_producto("");
$this->setCantidad_elaborada("");
$this->setCosto_unitario_producto("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM elaboracion WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_elaboracion($row['id_elaboracion']);
$this->setId_producto($row['id_producto']);
$this->setCantidad_elaborada($row['cantidad_elaborada']);
$this->setCosto_unitario_producto($row['costo_unitario_producto']);
}else{
$this->setId_elaboracion("");
$this->setId_producto("");
$this->setCantidad_elaborada("");
$this->setCosto_unitario_producto("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
$sql = "SELECT * FROM elaboracion order by id";
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
public static function setElaboracion($id_elaboracion, $id_producto, $cantidad_elaborada, $costo_unitario_producto, &$texto) {
$mysqli->query("SET NAMES UTF8");
$info_carga = info_carga();
if (empty($id)){
$sql = "INSERT INTO elaboracion (id_producto, cantidad_elaborada, costo_unitario_producto) VALUES ('$id_producto', '$cantidad_elaborada', '$costo_unitario_producto')";
$texto = "Se agregó correctamente el nuevo registro";
}else{
$sql = "UPDATE elaboracion SET id_producto='$id_producto', cantidad_elaborada='$cantidad_elaborada', costo_unitario_producto='$costo_unitario_producto' WHERE id = $id";
$texto = "Se actualizaron los datos del registro";
}
return $mysqli->query($sql);
}
public function getId_elaboracion() {
return $this->id_elaboracion;
}
public function setId_elaboracion($id_elaboracion) {
$this->id_elaboracion = $id_elaboracion;
}
public function getId_producto() {
return $this->id_producto;
}
public function setId_producto($id_producto) {
$this->id_producto = $id_producto;
}
public function getCantidad_elaborada() {
return $this->cantidad_elaborada;
}
public function setCantidad_elaborada($cantidad_elaborada) {
$this->cantidad_elaborada = $cantidad_elaborada;
}
public function getCosto_unitario_producto() {
return $this->costo_unitario_producto;
}
public function setCosto_unitario_producto($costo_unitario_producto) {
$this->costo_unitario_producto = $costo_unitario_producto;
}
}




?>
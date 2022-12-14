<?php 
include_once 'Conexion.php';
global $mysqli;
class Productos {
 private $id_producto ;
 private $nombre_producto ;
 function __construct() {
$this->setId_producto("");
$this->setNombre_producto("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM productos WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_producto($row['id_producto']);
$this->setNombre_producto($row['nombre_producto']);
}else{
$this->setId_producto("");
$this->setNombre_producto("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
$sql = "SELECT * FROM productos order by id";
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
public static function setProductos($id_producto, $nombre_producto, &$texto) {
$mysqli->query("SET NAMES UTF8");
$info_carga = info_carga();
if (empty($id)){
$sql = "INSERT INTO productos (nombre_producto) VALUES ('$nombre_producto')";
$texto = "Se agregó correctamente el nuevo registro";
}else{
$sql = "UPDATE productos SET nombre_producto='$nombre_producto' WHERE id = $id";
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
public function getNombre_producto() {
return $this->nombre_producto;
}
public function setNombre_producto($nombre_producto) {
$this->nombre_producto = $nombre_producto;
}
}




?>
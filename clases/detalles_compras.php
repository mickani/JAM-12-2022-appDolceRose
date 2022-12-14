<?php 
include_once 'conexion/Conexion.php';
//global $mysqli;
class Detalles_compras {
 private $id_compra ;
 private $id_materia_prima ;
 private $cantidad ;
 private $costo ;
 function __construct() {
$this->setId_compra("");
$this->setId_materia_prima("");
$this->setCantidad("");
$this->setCosto("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM detalles_compras WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_compra($row['id_compra']);
$this->setId_materia_prima($row['id_materia_prima']);
$this->setCantidad($row['cantidad']);
$this->setCosto($row['costo']);
}else{
$this->setId_compra("");
$this->setId_materia_prima("");
$this->setCantidad("");
$this->setCosto("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
$sql = "SELECT * FROM detalles_compras order by id";
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
public static function setDetalles_compras($id_compra, $id_materia_prima, $cantidad, $costo, &$texto) {
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    
            $sql = "INSERT INTO detalles_compras (id_compra, id_materia_prima, cantidad, costo) VALUES ('$id_compra','$id_materia_prima', '$cantidad', '$costo')";
            $texto = "Se agregó correctamente el nuevo registro";
    
    return $mysqli->query($sql);
}
public static function acDetalles_compras($id_compra, $id_materia_prima,$id_anterior, $cantidad, $costo, &$texto) {
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    
            $sql = "UPDATE detalles_compras SET id_materia_prima='$id_materia_prima', cantidad='$cantidad', costo='$costo' WHERE id_compra = $id_compra and id_materia_prima=$id_anterior";
            $texto = "Se actualizaron los datos del registro";
       
    return $mysqli->query($sql);
}
public function getId_compra() {
return $this->id_compra;
}
public function setId_compra($id_compra) {
$this->id_compra = $id_compra;
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
public function getCosto() {
return $this->costo;
}
public function setCosto($costo) {
$this->costo = $costo;
}

///   Elimina una referencia ingresada por un empleado 
public static function eliminar($id_compra, $id_mp){
    $sql="DELETE FROM detalles_compras WHERE detalles_compras.id_compra = $id_compra and detalles_compras.id_materia_prima=$id_mp";
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    return $mysqli->query($sql);
}
}




?>
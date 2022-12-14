<?php 
include_once 'conexion/Conexion.php';
//global $mysqli;
class Proveedores {
 private $id_proveedor ;
 private $nombre_proveedor ;
 function __construct() {
$this->setId_proveedor("");
$this->setNombre_proveedor("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM proveedores WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_proveedor($row['id_proveedor']);
$this->setNombre_proveedor($row['nombre_proveedor']);
}else{
$this->setId_proveedor("");
$this->setNombre_proveedor("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
    $sql = "SELECT * FROM proveedores order by id_proveedor";
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    $result = $mysqli->query($sql);
    if ($result->num_rows>0){
        //$mostrar =  '<select class="form-control select2" name="'.$name.'" id="'.$name.'">';
        $mostrar =  '<option value="-1">Seleccione..</option>';
        $selected='';
        while ($row = $result->fetch_array()){
            if ($valor==$row['id_proveedor']) 
                $selected='selected';
            else 
                $selected='';
            $mostrar .=  '<option '.$selected.' value="'.$row['id_proveedor'].'">'.$row['nombre_proveedor'].'</option>';
        }
    /*fin while*/
       // $mostrar .=  '</select>';
    }
    else{
        $mostrar = "No existen módulos cargados";
    }
    return $mostrar;
}
/*fin function select*/
public static function setProveedores($id_proveedor, $nombre_proveedor, &$texto) {
$mysqli=OpenConnection();
$mysqli->query("SET NAMES UTF8");
if (empty($id_proveedor)){
$sql = "INSERT INTO proveedores (nombre_proveedor) VALUES ('$nombre_proveedor')";
$texto = "Se agregó correctamente el nuevo registro";
}else{
$sql = "UPDATE proveedores SET nombre_proveedor='$nombre_proveedor' WHERE id_proveedor = $id_proveedor";
$texto = "Se actualizaron los datos del registro";
}
return $mysqli->query($sql);
}
public function getId_proveedor() {
return $this->id_proveedor;
}
public function setId_proveedor($id_proveedor) {
$this->id_proveedor = $id_proveedor;
}
public function getNombre_proveedor() {
return $this->nombre_proveedor;
}
public function setNombre_proveedor($nombre_proveedor) {
$this->nombre_proveedor = $nombre_proveedor;
}


public static function listar() {
$sql = "SELECT * FROM proveedores order by id_proveedor;";
$mysqli=OpenConnection();
$mysqli->query("SET NAMES UTF8");
return $mysqli->query($sql);

}

///   Elimina una referencia ingresada por un empleado 
public function eliminar($id_proveedor){
    $sql="DELETE FROM proveedores WHERE proveedores.id_proveedor ='$id_proveedor'";
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    return $mysqli->query($sql);
}

}




?>
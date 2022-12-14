<?php 
include_once 'conexion/Conexion.php';
//global $mysqli;
class Compras {
 private $id_compra ;
 private $id_proveedor ;
 private $fecha_compra ;
 function __construct() {
$this->setId_compra("");
$this->setId_proveedor("");
$this->setFecha_compra("");
 }
/*fin function __construct*/
 public function obtener($id) {
$sql = "SELECT * FROM compras WHERE id = $id";
$mysqli->query("SET NAMES UTF8");
$result = $mysqli->query($sql);
if ($result->num_rows>0){
$row = $result->fetch_array();
$this->setId_compra($row['id_compra']);
$this->setId_proveedor($row['id_proveedor']);
$this->setFecha_compra($row['fecha_compra']);
}else{
$this->setId_compra("");
$this->setId_proveedor("");
$this->setFecha_compra("");
}
}
/*fin function obtener*/
public static function select($name, $valor=-1) {
    $sql = "SELECT * FROM compras order by id";
    $mysqli->query("SET NAMES UTF8");
    $result = $mysqli->query($sql);
    if ($result->num_rows>0){
        $mostrar =  '<select class="form-control select2" name="'.$name.'" id="'.$name.'">';
        $mostrar .=  '<option value="-1">Seleccione..</option>';
        $selected='';
        while ($row = $result->fetch_array()){
            if ($valor==$row['id']) 
                $selected='selected'; 
            else $selected='';
            $mostrar .=  '<option '.$selected.' value="'.$row['id'].'">'.$row['nombre'].'</option>';
        }
    /*fin while*/
        $mostrar .=  '</select>';
    }else{
        $mostrar = "No existen módulos cargados";
    }
    return $mostrar;
}
/*fin function select*/
public static function setCompras($id_compra, $id_proveedor, $fecha_compra, &$texto) {
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    if (empty($id_compra)){
            $sql = "INSERT INTO compras (id_proveedor, fecha_compra) VALUES ('$id_proveedor', '$fecha_compra')";
            $texto = "Se agregó correctamente el nuevo registro";
        }else{
            $sql = "UPDATE compras SET id_proveedor='$id_proveedor', fecha_compra='$fecha_compra' WHERE id_compra = $id_compra";
            $texto = "Se actualizaron los datos del registro";
        }
    $rspta =$mysqli->query($sql);
    if($rspta){
        if (empty($id_compra)){
            return $mysqli->insert_id;
        }else{
            return $id_compra;
        }
    }else{
        return "-1";
        }
}

public function getId_compra() {
return $this->id_compra;
}
public function setId_compra($id_compra) {
$this->id_compra = $id_compra;
}
public function getId_proveedor() {
return $this->id_proveedor;
}
public function setId_proveedor($id_proveedor) {
$this->id_proveedor = $id_proveedor;
}
public function getFecha_compra() {
return $this->fecha_compra;
}
public function setFecha_compra($fecha_compra) {
$this->fecha_compra = $fecha_compra;
}


public static function listar() {
$sql = "SELECT co.id_compra, mp.id_materia_prima id_mp,pro.id_proveedor id_pro,pro.nombre_proveedor, co.fecha_compra, mp.nombre_materia_prima, dco.cantidad, dco.costo FROM compras co inner join proveedores pro on co.id_proveedor = pro.id_proveedor inner join detalles_compras dco on co.id_compra = dco.id_compra inner join materias_primas mp on dco.id_materia_prima = mp.id_materia_prima order by co.id_compra;";
$mysqli=OpenConnection();
$mysqli->query("SET NAMES UTF8");
return $mysqli->query($sql);

}

///   Elimina una referencia ingresada por un empleado 
public static function eliminar($id_compra){
    $sql="DELETE FROM compras WHERE compras.id_compra ='$id_compra'";
    $mysqli=OpenConnection();
    $mysqli->query("SET NAMES UTF8");
    return $mysqli->query($sql);
}
}


?>
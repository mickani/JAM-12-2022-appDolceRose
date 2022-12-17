<?php

include("db.php");

if(isset($_POST['id_producto']) && isset($_POST['cantidad']) && isset($_POST['fecha']) && isset($_POST['costo_unitario'])) {
  $id_producto = $_POST['id_producto'];
  $cantidad = $_POST['cantidad'];
  $fecha = $_POST['fecha'];
  $costo_unitario = $_POST['costo_unitario'];
  $query = "INSERT INTO elaboraciones(fecha_elaboracion, id_producto, costo_unitario_producto, cantidad_elaborada) VALUES('$fecha', $id_producto, $costo_unitario, $cantidad)";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
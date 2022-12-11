<?php

include("db.php");

if(isset($_POST['id_proveedor'])) {
  $id_proveedor = $_POST['id_proveedor'];
  $query = "SELECT * FROM proveedores WHERE id_proveedor = $id_proveedor";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $data = mysqli_fetch_row($result);
  $array_ajax['id'] = $data[0];
  $array_ajax['nombre'] = $data[1];
  print_r (json_encode($array_ajax));
}

?>
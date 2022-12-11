<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $query = "SELECT * FROM productos WHERE id_producto = $id_producto";
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
<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $query = "SELECT * FROM materias_primas_x_productos WHERE id_producto = $id_producto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $data = mysqli_fetch_row($result);
  $array_ajax['id_producto'] = $data[0];
  $array_ajax['id_materia_prima'] = $data[1];
  $array_ajax['cantidad'] = $data[3];
  print_r (json_encode($array_ajax));
}

?>
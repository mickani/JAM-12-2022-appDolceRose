<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $id_materia_prima = $_POST['id_materia_prima'];
  $cantidad = $_POST['cantidad'];
  $query = "UPDATE materias_primas_x_productos SET id_materia_prima = '$id_materia_prima', cantidad='$cantidad' WHERE id_producto = $id_producto";
  echo $query;
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}
?>
<?php

include("db.php");

if(isset($_POST['id_materia_prima']) && isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
  $id_producto = $_POST['id_producto'];
  $id_materia_prima = $_POST['id_materia_prima'];
  $cantidad = $_POST['cantidad'];
  $query = "INSERT INTO materias_primas_x_productos(id_producto, id_materia_prima, cantidad) VALUES($id_producto, $id_materia_prima, $cantidad)";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
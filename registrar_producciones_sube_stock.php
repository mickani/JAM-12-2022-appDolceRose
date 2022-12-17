<?php

include("db.php");

if(isset($_POST['id_elaboracion'])) {
  $id_elaboracion = $_POST['id_elaboracion'];
  $query = "SELECT id_producto, cantidad_elaborada FROM elaboraciones WHERE id_elaboracion = $id_elaboracion";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $data = mysqli_fetch_row($result);
  $id_producto = $data[0];
  $cantidad = $data[1];

  $query = "SELECT id_materia_prima, (cantidad * $cantidad) AS cantidad_descontar 
            FROM materias_primas_x_productos
            WHERE id_producto = $id_producto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  while ($data = mysqli_fetch_row($result))
  {
    $query = "UPDATE materias_primas SET 
              stock_actual = (stock_actual + $data[1])
              WHERE id_materia_prima = $data[0]";
    $exec = mysqli_query($conn, $query);
  }

}

?>
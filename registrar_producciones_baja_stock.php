<?php

include("db.php");

if(isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
  $id_producto = $_POST['id_producto'];
  $cantidad = $_POST['cantidad'];
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
              stock_actual = (stock_actual - $data[1])
              WHERE id_materia_prima = $data[0]";
    $exec = mysqli_query($conn, $query);
  }

}

?>
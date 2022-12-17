<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $query = "SELECT SUM(MP.costo * MPP.cantidad) AS costo_total 
            FROM materias_primas_x_productos AS MPP 
            INNER JOIN materias_primas AS MP ON MP.id_materia_prima = MPP.id_materia_prima 
            WHERE MPP.id_producto = $id_producto 
            GROUP BY MPP.id_producto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $data = mysqli_fetch_row($result);
  $array_ajax['costo'] = $data[0];
  print_r (json_encode($array_ajax));
}

?>
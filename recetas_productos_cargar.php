<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $query = "SELECT MPP.id_materia_prima, MP.nombre_materia_prima, MPP.cantidad 
            FROM materias_primas_x_productos AS MPP
            INNER JOIN materias_primas AS MP ON MP.id_materia_prima = MPP.id_materia_prima 
            WHERE MPP.id_producto = $id_producto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

   $detalle = array();

  while ($data = mysqli_fetch_row($result))
  {
      $array_detalle['id_materia_prima'] = $data[0];
      $array_detalle['nombre_materia_prima'] = $data[1];
      $array_detalle['cantidad'] = $data[2];
      $detalle.array_push($detalle, $array_detalle);
  }
  print_r (json_encode($detalle));

}


?>
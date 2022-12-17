<?php

include("db.php");

if(isset($_POST['id_compra']) && isset($_POST['id_materia_prima']) && isset($_POST['cantidad']) && isset($_POST['costo'])) {
  $id_compra = $_POST['id_compra'];
  $id_materia_prima = $_POST['id_materia_prima'];
  $cantidad = $_POST['cantidad'];
  $costo = $_POST['costo'];

  $query = "INSERT INTO detalles_compras(id_compra, id_materia_prima, cantidad, costo) 
            VALUES($id_compra, $id_materia_prima, $cantidad, $costo)"; 
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed INSERT.");
  }

  $query = "UPDATE materias_primas SET 
            stock_actual = (stock_actual + $cantidad), 
            costo = $costo 
            WHERE id_materia_prima = $id_materia_prima";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed UPDATE.");
  }

  //Traer todo el detalle para dibujarlo en la tabla
  $query = "SELECT MP.id_materia_prima, MP.nombre_materia_prima, DC.costo, DC.cantidad, (DC.costo * DC.cantidad) AS costo_total 
            FROM detalles_compras AS DC
            INNER JOIN materias_primas AS MP ON MP.id_materia_prima = DC.id_materia_prima 
            WHERE DC.id_compra = $id_compra";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed SELECT.");
  }

   $detalle = array();

  while ($data = mysqli_fetch_row($result))
  {
      $array_detalle['id_materia_prima'] = $data[0];
      $array_detalle['nombre_materia_prima'] = $data[1];
      $array_detalle['costo'] = $data[2];
      $array_detalle['cantidad'] = $data[3];
      $array_detalle['costo_total'] = $data[4];
      $detalle.array_push($detalle, $array_detalle);
  }
  print_r (json_encode($detalle));

}


?>
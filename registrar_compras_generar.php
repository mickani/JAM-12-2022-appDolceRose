<?php

include("db.php");

if(isset($_POST['id_proveedor']) && isset($_POST['fecha'])) {
  $id_proveedor = $_POST['id_proveedor'];
  $fecha = $_POST['fecha'];

  $query = "INSERT INTO compras(id_proveedor, fecha_compra) 
            VALUES($id_proveedor, '$fecha')"; 
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

    //Traer id_compra generado
  $query = "SELECT id_compra 
            FROM compras 
            ORDER BY id_compra DESC 
            LIMIT 1";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $data = mysqli_fetch_row($result);
  $array_ajax['id_compra'] = $data[0];
  print_r (json_encode($array_ajax));

}


?>
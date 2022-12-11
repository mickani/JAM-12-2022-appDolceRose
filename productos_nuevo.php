<?php

include("db.php");

if(isset($_POST['nombre_producto'])) {
  $nombre_producto = $_POST['nombre_producto'];
  $query = "INSERT INTO productos(nombre_producto) VALUES('".$nombre_producto."')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
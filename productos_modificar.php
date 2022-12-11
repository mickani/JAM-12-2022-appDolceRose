<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $nombre_producto = $_POST['nombre_producto'];
  $query = "UPDATE productos SET nombre_producto = '$nombre_producto' WHERE id_producto = $id_producto";
  echo $query;
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
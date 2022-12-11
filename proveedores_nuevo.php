<?php

include("db.php");

if(isset($_POST['nombre_proveedor'])) {
  $nombre_proveedor = $_POST['nombre_proveedor'];
  $query = "INSERT INTO proveedores(nombre_proveedor) VALUES('".$nombre_proveedor."')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
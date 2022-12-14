<?php

include("db.php");

if(isset($_POST['id_proveedor'])) {
  $id_proveedor = $_POST['id_proveedor'];
  $nombre_proveedor = $_POST['nombre_proveedor'];
  $query = "UPDATE proveedores SET nombre_proveedor = '$nombre_proveedor' WHERE id_proveedor = $id_proveedor";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
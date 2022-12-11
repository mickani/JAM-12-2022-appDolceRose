<?php

include("db.php");

if(isset($_POST['id_proveedor'])) {
  $id_proveedor = $_POST['id_proveedor'];
  $query = "DELETE FROM proveedores WHERE id_proveedor = $id_proveedor";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
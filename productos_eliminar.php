<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $query = "DELETE FROM productos WHERE id_producto = $id_producto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
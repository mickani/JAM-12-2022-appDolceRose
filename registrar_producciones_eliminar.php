<?php

include("db.php");

if(isset($_POST['id_elaboracion'])) {
  $id_elaboracion = $_POST['id_elaboracion'];
  $query = "DELETE FROM elaboraciones WHERE id_elaboracion = $id_elaboracion";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
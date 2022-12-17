<?php

include("db.php");

if(isset($_POST['id_materia_prima']) && isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $id_materia_prima = $_POST['id_materia_prima'];
  $query = "DELETE FROM materias_primas_x_productos WHERE id_producto = $id_producto AND id_materia_prima = $id_materia_prima";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
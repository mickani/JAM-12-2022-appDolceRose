<?php

include("db.php");

if(isset($_POST['id_producto'])) {
  $id_producto = $_POST['id_producto'];
  $id_materia_prima = $_POST['id_materia_prima'];
  $cantidad = $_POST['cantidad'];

  $query = "DELETE FROM materias_primas_x_productos WHERE id_materia_prima = $id_materia_prima AND cantidad=$cantidad" ;
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
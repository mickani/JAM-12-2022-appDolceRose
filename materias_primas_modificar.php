<?php

include("db.php");

if(isset($_POST['id_materia_prima'])) {
  $id_materia_prima = $_POST['id_materia_prima'];
  $nombre_materia_prima = $_POST['nombre_materia_prima'];
  $stock_actual = $_POST['stock_actual'];
  $stock_minimo = $_POST['stock_minimo'];
  $costo = $_POST['costo'];
  $query = "UPDATE materias_primas SET nombre_materia_prima = '$nombre_materia_prima',
                                       stock_actual = $stock_actual, 
                                       stock_minimo = $stock_minimo,
                                       costo = $costo 
                                       WHERE id_materia_prima = $id_materia_prima";
  echo $query;
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
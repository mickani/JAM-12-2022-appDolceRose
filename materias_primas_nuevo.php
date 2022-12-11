<?php

include("db.php");

if(isset($_POST['nombre_materia_prima'])) {
  $nombre_materia_prima = $_POST['nombre_materia_prima'];
  $stock_actual = $_POST['stock_actual'];
  $stock_minimo = $_POST['stock_minimo'];
  $costo = $_POST['costo'];
  $query = "INSERT INTO materias_primas(nombre_materia_prima, stock_actual, stock_minimo, costo) 
            VALUES('".$nombre_materia_prima."', ".$stock_actual.", ".$stock_minimo.", ".$costo.")";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
}

?>
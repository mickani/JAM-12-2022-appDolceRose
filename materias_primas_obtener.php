<?php

include("db.php");

if(isset($_POST['id_materia_prima'])) {
  $id_materia_prima = $_POST['id_materia_prima'];
  $query = "SELECT * FROM materias_primas WHERE id_materia_prima = $id_materia_prima";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }
  $data = mysqli_fetch_row($result);
  $array_ajax['id'] = $data[0];
  $array_ajax['nombre'] = $data[1];
  $array_ajax['stock_actual'] = $data[2];
  $array_ajax['stock_minimo'] = $data[3];
  $array_ajax['costo'] = $data[4];
  print_r (json_encode($array_ajax));
}

?>

<?php 

include("db.php");

//!!!!! CORROBORAR PORQUE SUPUESTAMENTE TRAE id_proveedor Y id_materia_prima
if (isset($_POST['registrar_compras_nuevo'])){
   $nombre = $_POST['nombre_proveedor'];
   $fecha = $_POST['fecha'];
   $materia_prima = $_POST['materia_prima'];
   $cantidad = $_POST['cantidad'];
   $costo = $_POST['costo'];

   //!!!!! CORROBORAR SINTAXIS DE "$query"
   $query = "INSERT INTO detalles_compras(nombre_proveedor, fecha, materia_prima, cantidad, costo) VALUES ('$nombre_proveedor', $fecha, '$materia_prima', $cantidad, $costo)";
   $result = mysqli_query($conn, $query);
   if (!$result) {
    die("falló");
   }

// -- MENSAJE INFORMATIVO LUEGO DE REGISTRAR COMPRA (opcional, hay q "llamarlo") --

//    $_SESSION['message'] = 'Compra guardada con éxito.';
//    $_SESSION['message_type']= 'success';
   
   header("Location: registrar_compras.php");
}

?>
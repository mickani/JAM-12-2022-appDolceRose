<?php
    include("db.php");

    // !!!!! CORROBORAR LOS "id" QUE RECIBE POR PARÁMETRO EL POST
    if(isset($_POST['id'])){

        $id = $_POST['id'];
        // !!!!! CORROBORAR SINTAXIS Y LOS "id"
        $query = "DELETE FROM detalles_compras WHERE detalles_compras.id_compra = $id AND detalles_compras.id_materia_prima = $id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Falló");    
        }

        header("Location: registrar_compras.php");
    }
?>
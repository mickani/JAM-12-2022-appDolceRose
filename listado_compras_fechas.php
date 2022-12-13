<?php

include("db.php");

$desde_fecha=$_POST['desde_fecha'];
$hasta_fecha=$_POST['hasta_fecha'];

$query = $bd->query("SELECT * FROM compras WHERE fecha_compra BETWEEN '{$desde_fecha}' AND '{$hasta_fecha}'");

while($compra=$listaCompra->fetch(PDO::FETCH_ASSOC))
{
    echo $compra['id_proveedor'].'<br>';
}


?>
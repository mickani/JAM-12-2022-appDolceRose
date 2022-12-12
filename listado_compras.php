<?php include("db.php") ?>
<?php include("header.php") ?>

<hr class="border border-primary">
<h2 align="center" class="text-primary p-4">LISTA DE COMPRAS</h2>
<hr class="border border-primary">

<div class="container text-center">
    <div class="row align-items-start border rounded p-3">
        <div class="col-6">
            <h5>Desde fecha</h5>
            <input type="date" name="desde_fecha" id="desde_fecha">
        </div>
        <div class="col-6">
            <h5>Hasta fecha</h5>
            <input type="date" name="hasta_fecha" id="hasta_fecha">
        </div>
        <div class="row align-items-center m-2">
            <div class="col">
                <button style="width:20%" class="btn btn-primary"><b>Buscar</b></button>
            </div>
        </div>

        <div class="mt-5">
            <h4 class="text-secondary">Listado de compras por fechas</h4>
            <table class="table table-striped bg-secondary rounded" style="--bs-bg-opacity: .2;">
                <thead>
                    <tr>
                        <th><b>id_compra</b></th>
                        <th><b>id_proveedor (nombre)</b></th>
                        <th><b>Fecha</b></th>
                        <th><b>Detalles</b></th>
                    </tr>
                </thead>

                <tbody>

                    <!-- PHP -->
                    <?php
                            $query = "SELECT * FROM compras ORDER BY id_compra";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>

                    <tr>
                        <td>
                            <p class="text-dark"><b><?php echo $row['id_compra']; ?></b></p>
                        </td>
                        <td>
                            <p class="text-dark"><?php echo $row['id_proveedor']; ?>
                        </td>
                        <td>
                            <p class="text-dark"><?php echo $row['fecha_compra']; ?></p>
                        </td>
                        <td>
                            <button type="button" class="btn btn-secondary">Ver</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">
        <h4 class="text-primary">Detalle de Compra</h4>
        <table class="table table-striped bg-success rounded" style="--bs-bg-opacity: .2;">
            <thead>
                <tr>
                    <th><b>ID_MATERIA PRIMA</b></th>
                    <th><b>CANTIDAD</b></th>
                    <th><b>COSTO $</b></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>
                        <!-- columna: MATERIA PRIMA -->
                        <p class="text-dark"><b>1</b></p>
                    </td>
                    <td>
                        <!-- columna: CANTIDAD -->
                        <p class="text-dark"><b></b>12</p>
                    </td>
                    <td>
                        <!-- columna: COSTO -->
                        <p class="text-dark"><b>$3445</b></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include("footer.php") ?>
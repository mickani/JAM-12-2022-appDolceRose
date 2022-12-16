<?php include("db.php") ?>
<?php include("header.php") ?>

    <?php 
        $fecha_desde = date('Y-m-d');
        $fecha_hasta = date('Y-m-d');
        if(isset($_POST['desde']) && isset($_POST['hasta'])){
            $fecha_desde = $_POST['desde'];
            $fecha_hasta = $_POST['hasta'];
        }
    ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Listado de producción por fechas</h3>
    </div>

    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-3">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="listado_producciones.php" name="frm_listado_producciones" id="frm_listado_producciones" method="POST">
                        <div class="form-group">
                            <label for="desde" class="form-label">Desde:</label>
                            <input type="date" name="desde" id="desde" class="form-control" value="<?php echo $fecha_desde ?>">
                        </div>
                        <div class="mt-2 form-group">
                            <label for="hasta" class="form-label">Hasta:</label>
                            <input type="date" name="hasta" id="hasta" class="form-control" value="<?php echo $fecha_hasta ?>">
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_fechas()" class="btn btn-info btn-block">Hoy</button>
                            <button type="submit" class="btn btn-success btn-block">Mostrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col-md-9">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Fecha</th>    
                            <th class="text-center">Producto</th>
                            <th class="text-center">Costo unitaro</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Costo total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT E.id_elaboracion, E.fecha_elaboracion, P.nombre_producto, E.costo_unitario_producto, E.cantidad_elaborada, SUM(E.costo_unitario_producto * E.cantidad_elaborada) AS costo_total 
                                      FROM elaboraciones AS E 
                                      INNER JOIN productos AS P ON P.id_producto = E.id_producto 
                                      WHERE fecha_elaboracion BETWEEN '$fecha_desde' AND '$fecha_hasta' 
                                      GROUP BY E.id_elaboracion
                                      ORDER BY E.id_elaboracion";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_elaboracion']; ?></td>
                                <td class="text-end"><?php echo $row['fecha_elaboracion']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td class="text-end"><?php echo $row['costo_unitario_producto']; ?></td>
                                <td class="text-end"><?php echo $row['cantidad_elaborada']; ?></td>
                                <td class="text-end"><?php echo $row['costo_total']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <script type="text/javascript">

        function limpiar_fechas(){
            var fecha_desde = document.getElementById("desde");
            var fecha_hasta = document.getElementById("hasta");
            fecha_desde.value = moment(new Date()).format('YYYY-MM-DD');
            fecha_hasta.value = moment(new Date()).format('YYYY-MM-DD');
            location.href='listado_producciones.php';
        }


    </script>

<?php include("footer2.php") ?>
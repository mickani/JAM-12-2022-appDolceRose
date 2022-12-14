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
        <h3>Listado de compras por fechas</h3>
    </div>

    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-3">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="listado_compras.php" name="frm_listado_compras" id="frm_listado_compras" method="POST">
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
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Fecha compra</th>
                            <th class="text-center">Costo compra</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT C.id_compra, P.nombre_proveedor, C.fecha_compra, SUM(DC.costo * DC.cantidad) AS costo_compra 
                                      FROM compras AS C 
                                      INNER JOIN detalles_compras AS DC ON DC.id_compra = C.id_compra 
                                      INNER JOIN proveedores AS P ON C.id_proveedor = P.id_proveedor 
                                      WHERE fecha_compra BETWEEN '$fecha_desde' AND '$fecha_hasta' 
                                      GROUP BY C.id_compra
                                      ORDER BY C.id_compra";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_compra']; ?></td>
                                <td><?php echo $row['nombre_proveedor']; ?></td>
                                <td class="text-end"><?php echo $row['fecha_compra']; ?></td>
                                <td class="text-end"><?php echo $row['costo_compra']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="ver_detalle(<?php echo $row['id_compra']?>)" class="btn btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- SUB-TITLE -->
    <div class="row text-center">
        <h5>Detalle de la compra</h5>
    </div>

    <div class="mx-5">
        <!-- TABLE -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">ID</th>    
                    <th class="text-center">Materia prima</th>
                    <th class="text-center">Costo</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Costo total</th>
                </tr>
            </thead>
            <tbody id="DataResult">
            </tbody>
        </table>
    </div>
    

    <script type="text/javascript">

        function limpiar_fechas(){
            var fecha_desde = document.getElementById("desde");
            var fecha_hasta = document.getElementById("hasta");
            fecha_desde.value = moment(new Date()).format('YYYY-MM-DD');
            fecha_hasta.value = moment(new Date()).format('YYYY-MM-DD');
            location.href='listado_compras.php';
        }

        function ver_detalle(id){
            $.ajax({
                type: "POST",
                url: "listado_compras_detalle.php",
                data: {id_compra: id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                    html += '<tr>' +
                                '<td>' + data[i].id_materia_prima + '</td>' +
                                '<td>' + data[i].nombre_materia_prima + '</td>' +
                                '<td class="text-end">' + data[i].costo + '</td>' +
                                '<td class="text-end">' + data[i].cantidad + '</td>' +
                                '<td class="text-end">' + data[i].costo_total + '</td>' +
                            '</tr>';
                    }
                    $('#DataResult').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error...');
                }
            });
        }

    </script>

<?php include("footer.php") ?>
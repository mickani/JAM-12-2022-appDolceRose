<?php include("db.php") ?>
<?php include("header.php") ?>

<main class="container-fluid p-2">

    <!-- TITLE -->
    <div class="row text-center my-1">
        <h3>Listado de productos con costo actual</h3>
    </div>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-8 my-2 my-md-0">
                <table class="table table-sm table-bordered table-secondary table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>    
                            <th class="text-center">Producto</th>
                            <th class="text-center">Costo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT P.id_producto, P.nombre_producto, MP.costo, MPP.cantidad, SUM(MPP.cantidad * MP.costo) AS costo_total 
                                      FROM materias_primas_x_productos AS MPP 
                                      INNER JOIN productos AS P ON P.id_producto = MPP.id_producto 
                                      INNER JOIN materias_primas AS MP ON MP.id_materia_prima = MPP.id_materia_prima 
                                      GROUP BY P.id_producto 
                                      ORDER BY P.nombre_producto";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_producto']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td class="text-end"><?php echo $row['costo_total']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="ver_detalle(<?php echo $row['id_producto']?>)" class="btn btn-primary">
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
        <h5>Detalle de la receta</h5>
    </div>

    <div class="mx-5">
        <!-- TABLE -->
        <table class="table table-sm table-bordered table-secondary table-striped">
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

        function ver_detalle(id){
            $.ajax({
                type: "POST",
                url: "listado_productos_costos_receta.php",
                data: {id_producto: id},
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

<?php include("footer2.php") ?>
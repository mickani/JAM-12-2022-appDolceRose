<?php include("db.php") ?>
<?php include("header.php") ?>

    <?php 
        $fecha = date('Y-m-d');
        if(isset($_POST['fecha'])){
            $fecha = $_POST['fecha'];
        }
    ?>

<main class="container-fluid p-2">

    <!-- TITLE -->
    <div class="row text-center my-2">
        <h3>Registro de producción (últimas 10)</h3>
    </div>
    
        <div class="row">
            <div class="col-12 col-md-4">

                <!-- FORM -->
                <div class="card card-body">
                    <form action="" name="frm_registrar_producciones" id="frm_registrar_producciones" method="POST">
                        <!-- SELECT PRODUCTO CON RECETA LISTA -->
                        <div class="form-group my-2">
                            <label for="cbo_productos" class="form-label">Seleccione un producto:</label>
                            <select class="form-select" name="cbo_productos" id="cbo_productos">
                                <option value="0">Seleccione un producto</option>
                                <?php
                                    //$query = "SELECT id_producto, nombre_producto FROM productos ORDER BY nombre_producto ";
                                    $query = "SELECT P.id_producto, P.nombre_producto 
                                      FROM materias_primas_x_productos AS MPP 
                                      INNER JOIN productos AS P ON P.id_producto = MPP.id_producto 
                                      INNER JOIN materias_primas AS MP ON MP.id_materia_prima = MPP.id_materia_prima 
                                      GROUP BY P.id_producto 
                                      ORDER BY P.nombre_producto";
                                      // ESTO TRAE SOLO PRODUCTOS CON RECETA LISTA
                                    $result = mysqli_query($conn, $query);
                                    while ($valores = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $valores['id_producto'] ?>"><?php echo $valores["nombre_producto"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" value="<?php echo $fecha ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_formulario()" class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="registrar_produccion()" class="btn btn-success btn-block">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABLE -->
            <div class="col-12 col-md-8 my-3 my-md-0">
                <table class="table table-bordered table-secondary table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Fecha</th>    
                            <th class="text-center">Producto</th>
                            <th class="text-center">Costo unitaro</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Costo total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT E.id_elaboracion, E.fecha_elaboracion, P.nombre_producto, E.costo_unitario_producto, E.cantidad_elaborada, SUM(E.costo_unitario_producto * E.cantidad_elaborada) AS costo_total 
                                      FROM elaboraciones AS E 
                                      INNER JOIN productos AS P ON P.id_producto = E.id_producto 
                                      GROUP BY E.id_elaboracion
                                      ORDER BY E.id_elaboracion DESC 
                                      LIMIT 10";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_elaboracion']; ?></td>
                                <td class="text-end"><?php echo $row['fecha_elaboracion']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td class="text-end"><?php echo $row['costo_unitario_producto']; ?></td>
                                <td class="text-end"><?php echo $row['cantidad_elaborada']; ?></td>
                                <td class="text-end"><?php echo $row['costo_total']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="eliminar_produccion(<?php echo $row['id_elaboracion']?>)" class="btn btn-danger">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>


    <script type="text/javascript">

        function limpiar_formulario(){
            var cbo_productos = document.getElementById("cbo_productos");
            var cantidad = document.getElementById("cantidad");
            var fecha = document.getElementById("fecha");
            cbo_productos.selectedIndex = 0;
            //fecha.value = moment(new Date()).format('YYYY-MM-DD');
            cantidad.value = "";
        }

        function registrar_produccion(){
            var cbo_productos = document.getElementById("cbo_productos");
            var id_producto = cbo_productos.selectedOptions[0].value;
            var cantidad = document.getElementById("cantidad");
            var fecha = document.getElementById("fecha");
            fecha.value = moment(new Date()).format('YYYY-MM-DD');
            if(id_producto == 0){
                alert("Debe seleccionar un producto.");
                return;
            }
            if(cantidad.value <= 0){
                alert("Ingrese una cantidad adecuada.");
                return;
            }
            if(confirm("¿Registrar la producción de " + cantidad.value + " " + cbo_productos.selectedOptions[0].text + " ?")){
                $.ajax({
                    type: "POST",
                    url: "registrar_producciones_obtener_costo.php",
                    data: {id_producto:id_producto},
                    success: function(result) {
                        var data = $.parseJSON(result);
                        var costo_unitario = data.costo;
                        $.ajax({
                            type: "POST",
                            url: 'registrar_producciones_guardar.php',
                            data: {id_producto:id_producto, cantidad:cantidad.value, fecha:fecha.value, costo_unitario:costo_unitario},
                            success: function (response) {
                                $.ajax({
                                    type: "POST",
                                    url: 'registrar_producciones_baja_stock.php',
                                    data: {id_producto:id_producto, cantidad:cantidad.value},
                                    success: function (final) {
                                        location.href='registrar_producciones.php';
                                    }
                                });
                            }
                        });
                    }
                });
            }
        }

        function eliminar_produccion(id_elaboracion){
            if(confirm("¿Eliminar la producción y devolver materias primas?")){
                $.ajax({
                    type: "POST",
                    url: "registrar_producciones_sube_stock.php",
                    data: {id_elaboracion:id_elaboracion},
                    success: function(result) {
                        $.ajax({
                            type: "POST",
                            url: 'registrar_producciones_eliminar.php',
                            data: {id_elaboracion:id_elaboracion},
                            success: function (response) {
                                location.href='registrar_producciones.php';
                            }
                        });
                    }
                });
            }
        }

    </script>

<?php include("footer2.php") ?>
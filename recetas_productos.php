<?php include("db.php") ?>
<?php include("header.php") ?>

    <?php 
        $id_prod = 0;
        if(isset($_POST['id_producto'])){
            $id_prod = $_POST['id_producto'];
        }
    ?>

<main class="container-fluid">

    <!-- TITLE -->
    <div class="row text-center my-2">
        <h3>Recetas de Productos</h3>
    </div>
   
        <div class="row">
            <div class="col-12 col-md-4">

                <!-- FORM -->
                <form action="" name="frm_recetas_productos" id="frm_recetas_productos" method="POST">
                    <div class="card card-body">

                        <!-- SELECT PRODUCTO -->
                        <div class="form-group my-2">
                            <label for="cbo_productos" class="form-label">Seleccione un producto:</label>
                            <select class="form-select" onchange="cbo_productos_change()" name="cbo_productos" id="cbo_productos">
                                <option value="0">Seleccione un producto</option>
                                <?php
                                    $query = "SELECT id_producto, nombre_producto FROM productos ORDER BY nombre_producto ";
                                    $result = mysqli_query($conn, $query);
                                    while ($valores = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $valores['id_producto'] ?>"><?php echo $valores["nombre_producto"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="card card-body mt-2">

                        <!-- SELECT MATERIAS PRIMAS -->
                        <div class="form-group mt-2">
                            <label for="cbo_materias_primas" class="form-label">Seleccione una materia prima:</label>
                            <select class="form-select" name="cbo_materias_primas" id="cbo_materias_primas">
                                <option value="0">Seleccione una materia prima</option>
                                <?php
                                    $query = "SELECT id_materia_prima, nombre_materia_prima FROM materias_primas ORDER BY nombre_materia_prima ";
                                    $result = mysqli_query($conn, $query);
                                    while ($valores = mysqli_fetch_array($result)) {
                                        ?>
                                        <option value="<?php echo $valores['id_materia_prima'] ?>"><?php echo $valores["nombre_materia_prima"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_frm_recetas_productos()" class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="agregar_materia_prima()" class="btn btn-success btn-block">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="col-12 col-md-8 my-3 my-md-0">
                <table class="table table-bordered table-secondary table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="DataResult">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script type="text/javascript">

        //alert(cbo_productos.selectedOptions[0].value);
        //alert(cbo_productos.selectedOptions[0].text);

        function cbo_productos_change(){
            var cbo_productos = document.getElementById("cbo_productos");
            var id_producto = cbo_productos.selectedOptions[0].value;
            $.ajax({
                type: "POST",
                url: "recetas_productos_cargar.php",
                data: {id_producto: id_producto},
                success: function(result) {
                    limpiar_frm_recetas_productos();
                    var data = $.parseJSON(result);
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                    html += '<tr>' +
                                '<td>' + data[i].id_materia_prima + '</td>' +
                                '<td>' + data[i].nombre_materia_prima + '</td>' +
                                '<td class="text-end">' + data[i].cantidad + '</td>' +
                                '<td class="text-center"><a type="button" onclick="eliminar_materia_prima(' + data[i].id_materia_prima + ')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>' +
                            '</tr>';
                    }
                    $('#DataResult').html(html);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error...');
                }
            });
        }

        function limpiar_frm_recetas_productos(){
            var cbo_materias_primas = document.getElementById("cbo_materias_primas");
            var cantidad = document.getElementById("cantidad");
            cbo_materias_primas.selectedIndex = 0;
            cantidad.value = "";
        }

        function eliminar_materia_prima(id){
            var nombre_materia_prima = "";
            var encontrado = false;
            $.ajax({
                type: "POST",
                url: "materias_primas_obtener.php",
                data: {id_materia_prima:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_materia_prima = data.nombre;
                    encontrado = true;
                    if(confirm("¿Quitar la materia prima " + nombre_materia_prima + " de la receta?")){
                        var cbo_productos = document.getElementById("cbo_productos");
                        var id_producto = cbo_productos.selectedOptions[0].value;
                        $.ajax({
                            type: "POST",
                            url: 'recetas_productos_eliminar.php',
                            data: {id_materia_prima:id, id_producto:id_producto},
                            success: function (response) {
                                cbo_productos_change();
                            }
                        });
                    }
                }
            });
        }

        function agregar_materia_prima(){
            var cbo_productos = document.getElementById("cbo_productos");
            var id_producto = cbo_productos.selectedOptions[0].value;
            var cbo_materias_primas = document.getElementById("cbo_materias_primas");
            var id_materia_prima = cbo_materias_primas.selectedOptions[0].value;
            var cantidad = document.getElementById("cantidad");
            if(id_producto == 0){
                alert("Debe seleccionar un producto.");
                return;
            }
            if(id_materia_prima == 0){
                alert("Debe seleccionar una materia prima.");
                return;
            }
            if(cantidad.value <= 0){
                alert("Debe ingresar una cantidad adecuada.");
                return;
            }
            if(confirm("¿Agregar la materia prima a la receta?")){
                $.ajax({
                    type: "POST",
                    url: 'recetas_productos_agregar.php',
                    data: {id_producto:id_producto, id_materia_prima:id_materia_prima, cantidad:cantidad.value},
                    success: function (response) {
                        cbo_productos_change();
                    }
                });
            }
        }

    </script>

<?php include("footer2.php") ?>
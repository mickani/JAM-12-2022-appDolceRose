<?php include("db.php") ?>
<?php include("header.php") ?>

<?php 
        //$fecha = date('Y-m-d');
        if(isset($_POST['fecha'])){
            $fecha = $_POST['fecha'];
        }
        else{
            $fecha = date('Y-m-d');
        }
    ?>

<main class="container-fluid">

    <!-- TITLE -->
    <div class="row text-center my-2">
        <h3>Registro de compras</h3>
    </div>

    <div class="row">
        <div class="col-12 col-md-3">

            <!-- FORM -->
            <div class="card card-body">
                <form action="" name="frm_registrar_compras" id="frm_registrar_compras" method="POST">
                    <div class="card card-body">

                        <!-- SELECT PROVEEDOR -->
                        <div class="form-group">
                            <label for="id_compra" class="form-label">ID Compra:</label>
                            <input type="text" name="id_compra" id="id_compra" class="form-control" disabled>
                        </div>
                        <div class="form-group my-2">
                            <label for="cbo_proveedores" class="form-label">Seleccione un proveedor:</label>
                            <select class="form-select" name="cbo_proveedores" id="cbo_proveedores">
                                <option value="0">Seleccione un proveedor</option>
                                <?php
                                    $query = "SELECT id_proveedor, nombre_proveedor FROM proveedores ORDER BY nombre_proveedor ";
                                    $result = mysqli_query($conn, $query);
                                    while ($valores = mysqli_fetch_array($result)) {
                                        ?>
                                <option value="<?php echo $valores['id_proveedor'] ?>">
                                    <?php echo $valores["nombre_proveedor"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input type="date" name="fecha" id="fecha" class="form-control"
                                value="<?php echo $fecha ?>">
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="cerrar_compra()"
                                class="btn btn-info btn-block">Cerrar</button>
                            <button type="button" onclick="generar_compra()"
                                class="btn btn-success btn-block">Generar</button>
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
                                <option value="<?php echo $valores['id_materia_prima'] ?>">
                                    <?php echo $valores["nombre_materia_prima"] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="costo" class="form-label">Costo unitario:</label>
                            <input type="number" name="costo" id="costo" class="form-control" autofocus>
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_frm_compras()"
                                class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="agregar_materia_prima()"
                                class="btn btn-success btn-block">Agregar</button>
                        </div>
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
                        <th class="text-center">Materia prima</th>
                        <th class="text-center">Costo unitaro</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Costo total</th>
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
function limpiar_frm_compras() {
    var cbo_materias_primas = document.getElementById("cbo_materias_primas");
    var cantidad = document.getElementById("cantidad");
    var costo = document.getElementById("costo");
    var fecha = document.getElementById("fecha");
    cbo_materias_primas.selectedIndex = 0;
    cantidad.value = "";
    costo.value = "";
}

function cerrar_compra() {
    if (confirm("¿Cerrar la compra actual?")) {
        var id_compra = document.getElementById("id_compra");
        var cbo_proveedores = document.getElementById("cbo_proveedores");
        var fecha = document.getElementById("fecha");
        cbo_proveedores.selectedIndex = 0;
        id_compra.value = "0";
        fecha.value = moment(new Date()).format('YYYY-MM-DD');
        limpiar_frm_compras();
        var html = '';
        $('#DataResult').html(html);
    }
}

function agregar_materia_prima() {
    var id_compra = document.getElementById("id_compra");
    var cbo_materias_primas = document.getElementById("cbo_materias_primas");
    var id_materia_prima = cbo_materias_primas.selectedOptions[0].value;
    var cantidad = document.getElementById("cantidad");
    var costo = document.getElementById("costo");
    if (id_compra.value == 0) {
        alert("Debe generar la compra antes de cargar su detalle.");
        return;
    }
    if (id_materia_prima == 0) {
        alert("Debe seleccionar una materia prima.");
        return;
    }
    if (cantidad.value <= 0) {
        alert("Ingrese una cantidad adecuada.");
        return;
    }
    if (costo.value <= 0) {
        alert("Ingrese un costo adecuado.");
        return;
    }
    if (confirm("¿Agregar " + cantidad.value + " " + cbo_materias_primas.selectedOptions[0].text + " a la compra?")) {
        $.ajax({
            type: "POST",
            url: "registrar_compras_cargar.php",
            data: {
                id_compra: id_compra.value,
                id_materia_prima: id_materia_prima,
                cantidad: cantidad.value,
                costo: costo.value
            },
            success: function(result) {
                limpiar_frm_compras();
                var data = $.parseJSON(result);
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].id_materia_prima + '</td>' +
                        '<td>' + data[i].nombre_materia_prima + '</td>' +
                        '<td class="text-end">' + data[i].costo + '</td>' +
                        '<td class="text-end">' + data[i].cantidad + '</td>' +
                        '<td class="text-end">' + data[i].costo_total + '</td>' +
                        '<td class="text-center"><a type="button" onclick="eliminar_materia_prima(' + data[
                            i].id_materia_prima +
                        ')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>' +
                        '</tr>';
                }
                $('#DataResult').html(html);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error...');
            }
        });
    }
}

function eliminar_materia_prima(id_materia_prima) {
    var id_compra = document.getElementById("id_compra");
    if (confirm("¿Eliminar la materia prima del datalle?")) {
        $.ajax({
            type: "POST",
            url: "registrar_compras_eliminar.php",
            data: {
                id_compra: id_compra.value,
                id_materia_prima: id_materia_prima
            },
            success: function(result) {
                limpiar_frm_compras();
                var data = $.parseJSON(result);
                var html = '';
                for (var i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td>' + data[i].id_materia_prima + '</td>' +
                        '<td>' + data[i].nombre_materia_prima + '</td>' +
                        '<td class="text-end">' + data[i].costo + '</td>' +
                        '<td class="text-end">' + data[i].cantidad + '</td>' +
                        '<td class="text-end">' + data[i].costo_total + '</td>' +
                        '<td class="text-center"><a type="button" onclick="eliminar_materia_prima(' + data[
                            i].id_materia_prima +
                        ')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td>' +
                        '</tr>';
                }
                $('#DataResult').html(html);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error...');
            }
        });
    }
}

function generar_compra() {
    var id_compra = document.getElementById("id_compra");
    var cbo_proveedores = document.getElementById("cbo_proveedores");
    var id_proveedor = cbo_proveedores.selectedOptions[0].value;
    var fecha = document.getElementById("fecha");
    //fecha.value = moment(new Date()).format('YYYY-MM-DD');
    if (id_proveedor == 0) {
        alert("Debe seleccionar un proveedor.");
        return;
    }
    if (confirm("¿Generar una nueva compra?")) {
        $.ajax({
            type: "POST",
            url: "registrar_compras_generar.php",
            data: {
                id_proveedor: id_proveedor,
                fecha: fecha.value
            },
            success: function(result) {
                limpiar_frm_compras();
                var data = $.parseJSON(result);
                id_compra.value = data.id_compra;
            }
        });
    }
}
</script>

<?php include("footer2.php") ?>
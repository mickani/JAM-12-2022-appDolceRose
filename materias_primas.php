<?php include("db.php") ?>
<?php include("header.php") ?>

<main class="container-fluid">

    <!-- TITLE -->
    <div class="row text-center my-1">
        <h3>Mantenedor de Materias Primas</h3>
    </div>
    
        <div class="row">
            <div class="col-12 col-sm-12 col-md-4">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="" name="frm_materias_primas" id="frm_materias_primas" method="POST">
                        <div class="form-group">
                            <label for="id_materia_prima" class="form-label">ID:</label>
                            <input type="text" name="id_materia_prima" id="id_materia_prima" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nombre_materia_prima" class="form-label">Nombre materia prima:</label>
                            <input type="text" name="nombre_materia_prima" id="nombre_materia_prima" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="stock_actual" class="form-label">Stock actual:</label>
                            <input type="number" name="stock_actual" id="stock_actual" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="stock_minimo" class="form-label">Stock mínimo:</label>
                            <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="costo" class="form-label">Costo:</label>
                            <input type="number" name="costo" id="costo" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_frm_materias_primas()" class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="guardar_materia_prima()" class="btn btn-success btn-block">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- TABLE -->
            <div class="col-12 col-sm-12 col-md-8 my-2 my-md-0">
                <table class="table table-sm table-bordered table-secondary table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Stock Actual</th>
                            <th class="text-center">Stock Mínimo</th>
                            <th class="text-center">Costo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM materias_primas ORDER BY id_materia_prima";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_materia_prima']; ?></td>
                                <td><?php echo $row['nombre_materia_prima']; ?></td>
                                <td class="text-end"><?php echo $row['stock_actual']; ?></td>
                                <td class="text-end"><?php echo $row['stock_minimo']; ?></td>
                                <td class="text-end"><?php echo $row['costo']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="editar_materia_prima(<?php echo $row['id_materia_prima']?>)" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a type="button" onclick="eliminar_materia_prima(<?php echo $row['id_materia_prima']?>)" class="btn btn-danger">
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

        function limpiar_frm_materias_primas(){
            if(confirm("¿Limpiar el formulario?")){
                var id_materia_prima = document.getElementById("id_materia_prima");
                var nombre_materia_prima = document.getElementById("nombre_materia_prima");
                var stock_actual = document.getElementById("stock_actual");
                var stock_minimo = document.getElementById("stock_minimo");
                var costo = document.getElementById("costo");
                id_materia_prima.value = "";
                nombre_materia_prima.value = "";
                stock_actual.value = "";
                stock_minimo.value = "";
                costo.value = "";
            }
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
                    if(confirm("¿Eliminar la materia prima " + nombre_materia_prima +"?")){
                        $.ajax({
                            type: "POST",
                            url: 'materias_primas_eliminar.php',
                            data: {id_materia_prima:id},
                            success: function (response) {
                                location.href='materias_primas.php';
                            }
                        });
                    }
                }
            });
        }

        function editar_materia_prima(id){
            var id_materia_prima = document.getElementById("id_materia_prima");
            var nombre_materia_prima = document.getElementById("nombre_materia_prima");
            var stock_actual = document.getElementById("stock_actual");
            var stock_minimo = document.getElementById("stock_minimo");
            var costo = document.getElementById("costo");
            id_materia_prima.value = id;
            $.ajax({
                type: "POST",
                url: "materias_primas_obtener.php",
                data: {id_materia_prima:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_materia_prima.value = data.nombre;
                    stock_actual.value = data.stock_actual;
                    stock_minimo.value = data.stock_minimo;
                    costo.value = data.costo;
                }
            });
        }

        function guardar_materia_prima(){
            var id_materia_prima = document.getElementById("id_materia_prima");
            var nombre_materia_prima = document.getElementById("nombre_materia_prima");
            var stock_actual = document.getElementById("stock_actual");
            var stock_minimo = document.getElementById("stock_minimo");
            var costo = document.getElementById("costo");
            if(nombre_materia_prima.value == ""){
                alert("Debe ingresar un nombre de materia prima.");
                return;
            }
            if(stock_actual.value == 0){
                stock_actual.value = 0;
            }
            if(stock_minimo.value == 0){
                stock_minimo.value = 0;
            }
            if(costo.value == 0){
                costo.value = 0;
            }
            if(id_materia_prima.value == ""){
                if(confirm("¿Guardar la nueva materia prima?")){
                    $.ajax({
                        type: "POST",
                        url: 'materias_primas_nuevo.php',
                        data: $("#frm_materias_primas").serialize(),
                        success: function (response) {
                            location.href='materias_primas.php';
                        }
                    });
                }
            } else {
                if(confirm("¿Modificar la materia prima?")){
                    $.ajax({
                        type: "POST",
                        url: 'materias_primas_modificar.php',
                        data: {id_materia_prima:id_materia_prima.value, nombre_materia_prima:nombre_materia_prima.value, stock_actual:stock_actual.value, stock_minimo: stock_minimo.value, costo: costo.value},
                        success: function (response) {
                            location.href='materias_primas.php';
                        }
                    });
                }
            }
        }

    </script>

<?php include("footer2.php") ?>
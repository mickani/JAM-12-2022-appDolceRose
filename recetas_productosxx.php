<?php include("db.php") ?>
<?php include("header.php") ?>

    <?php 
        $id_prod = 0;
        if(isset($_POST['id_producto'])){
            $id_prod = $_POST['id_producto'];
        }
    ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Recetas de Productos</h3>
    </div>
    
    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-4">
                <!-- FORM -->
                <form action="" name="frm_recetas_productos" id="frm_recetas_productos" method="POST">
                    <!-- SELECT PRODUCTO -->
                    <div class="form-group my-2">
                        <label for="cbo_productos" class="form-label">Seleccione un producto:</label>
                        <select name="cbo_productos" id="cbo_productos" class="form-select" onchange="cbo_productos_change()">
                            <?php
                                $query = "SELECT id_producto, nombre_producto FROM productos ORDER BY nombre_producto ";
                                $result = mysqli_query($conn, $query);
                                while ($valores = mysqli_fetch_array($result)) {
                                    // $selected = "";
                                    // if ($valores['id_producto'] == $_POST['id_producto']) {
                                    //     $selected = 'selected="selected"';
                                    // }
                                    ?>
                                    <option value="<?php echo $valores['id_producto'] ?>"><?php echo $valores["nombre_producto"] ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="card card-body">
                        <div class="form-group">
                            <label for="id_materia_prima" class="form-label">ID:</label>
                            <input type="text" name="id_materia_prima" id="id_materia_prima" class="form-control" disabled>
                        </div>
                        <!-- SELECT MATERIAS PRIMAS -->
                        <div class="form-group mt-2">
                            <label for="cbo_materias_primas" class="form-label">Seleccione una materia prima:</label>
                            <select name="cbo_materias_primas" id="cbo_materias_primas" class="form-select">
                                <?php
                                    $query = "SELECT id_materia_prima, nombre_materia_prima FROM materias_primas ORDER BY nombre_materia_prima ";
                                    $result = mysqli_query($conn, $query);
                                    while ($valores = mysqli_fetch_array($result)) {
                                        $selected = "";
                                        if ($valores['id_materia_prima'] == $_POST['id_materia_prima']) {
                                            $selected = 'selected="selected"';
                                        }
                                        ?>
                                        <option value="<?php $valores['id_materia_prima'] ?>"><?php echo $valores["nombre_materia_prima"] ?></option>
                                <?php
                                    }
                                ?>
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
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Cantidad</th>
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
                                <td class="text-end"><?php echo $row['cantidad']; ?></td>
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

        $(document).ready(function() {
            var cbo_productos = document.getElementById("cbo_productos");
            cbo_productos.selectedIndex = -1;
            alert("ready!");
        });

        $('#cbo_producto').change(function() {
            var val = $("#cbo_producto option:selected").text();
            alert(val);
        });

        $('#cbo_producto').change(function() {
            var val = $("#cbo_producto option:selected").text();
            alert(val);
        });

        document.getElementById("cbo_producto").addEventListener('change', (event) => {
            alert(event.target.value);
        });

        function cbo_productos_change(){
            var cbo_productos = document.getElementById("cbo_productos");
            alert(cbo_productos.selectedOptions[0].value);
            alert(cbo_productos.selectedOptions[0].text);
        }

        function limpiar_frm_recetas_productos(){
            var cbo_materias_primas = document.getElementById("cbo_materias_primas");
            var cantidad = document.getElementById("cantidad");
            cbo_materias_primas.selectedIndex = -1;
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

        function agregar_materia_prima(){
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

<?php include("footer.php") ?>
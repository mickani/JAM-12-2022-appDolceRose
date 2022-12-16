<?php include("db.php") ?>
<?php include("header.php") ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Mantenedor de Proveedores</h3>
    </div>

    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-4">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="" name="frm_proveedores" id="frm_proveedores" method="POST">
                        <div class="form-group">
                            <label for="id_proveedor" class="form-label">ID:</label>
                            <input type="text" name="id_proveedor" id="id_proveedor" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nombre_proveedor" class="form-label">Nombre proveedor:</label>
                            <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_frm_proveedores()" class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="guardar_proveedor()" class="btn btn-success btn-block">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- TABLE -->
            <div class="col-md-8">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Proveedor</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM proveedores ORDER BY id_proveedor";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_proveedor']; ?></td>
                                <td><?php echo $row['nombre_proveedor']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="editar_proveedor(<?php echo $row['id_proveedor']?>)" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a type="button" onclick="eliminar_proveedor(<?php echo $row['id_proveedor']?>)" class="btn btn-danger">
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

        function limpiar_frm_proveedores(){
            if(confirm("¿Limpiar el formulario?")){
                var id_proveedor = document.getElementById("id_proveedor");
                var nombre_proveedor = document.getElementById("nombre_proveedor");
                id_proveedor.value = "";
                nombre_proveedor.value = "";
            }
        }

        function eliminar_proveedor(id){
            var nombre_proveedor = "";
            var encontrado = false;
            $.ajax({
                type: "POST",
                url: "proveedores_obtener.php",
                data: {id_proveedor:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_proveedor = data.nombre;
                    encontrado = true;
                    if(confirm("¿Eliminar al proveedor " + nombre_proveedor +"?")){
                        $.ajax({
                            type: "POST",
                            url: 'proveedores_eliminar.php',
                            data: {id_proveedor:id},
                            success: function (response) {
                                location.href='proveedores.php';
                            }
                        });
                    }
                }
            });
        }

        function editar_proveedor(id){
            var id_proveedor = document.getElementById("id_proveedor");
            var nombre_proveedor = document.getElementById("nombre_proveedor");
            id_proveedor.value = id;
            $.ajax({
                type: "POST",
                url: "proveedores_obtener.php",
                data: {id_proveedor:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_proveedor.value = data.nombre;
                }
            });
        }

        function guardar_proveedor(){
            var id_proveedor = document.getElementById("id_proveedor");
            var nombre_proveedor = document.getElementById("nombre_proveedor");
            if(nombre_proveedor.value == ""){
                alert("Debe ingresar un nombre de proveedor.");
                return;
            }
            if(id_proveedor.value == ""){
                if(confirm("¿Guardar el nuevo proveedor?")){
                    $.ajax({
                        type: "POST",
                        url: 'proveedores_nuevo.php',
                        data: $("#frm_proveedores").serialize(),
                        success: function (response) {
                            location.href='proveedores.php';
                        }
                    });
                }
            } else {
                if(confirm("¿Modificar el proveedor?")){
                    $.ajax({
                        type: "POST",
                        url: 'proveedores_modificar.php',
                        data: {id_proveedor:id_proveedor.value, nombre_proveedor:nombre_proveedor.value},
                        success: function (response) {
                            location.href='proveedores.php';
                        }
                    });
                }
            }
        }

    </script>

<?php include("footer2.php") ?>
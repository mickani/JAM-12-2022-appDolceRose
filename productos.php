<?php include("db.php") ?>
<?php include("header.php") ?>

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Mantenedor de Productos</h3>
    </div>
    
    <main class="container-fluid p-2">
        <div class="row">
            <div class="col-md-4">
                <!-- FORM -->
                <div class="card card-body">
                    <form action="" name="frm_productos" id="frm_productos" method="POST">
                        <div class="form-group">
                            <label for="id_producto" class="form-label">ID:</label>
                            <input type="text" name="id_producto" id="id_producto" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label for="nombre_producto" class="form-label">Nombre producto:</label>
                            <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" autofocus>
                        </div>
                        <div class="col-auto mt-2 text-center">
                            <button type="button" onclick="limpiar_frm_productos()" class="btn btn-info btn-block">Limpiar</button>
                            <button type="button" onclick="guardar_producto()" class="btn btn-success btn-block">Guardar</button>
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
                            <th class="text-center">Producto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM productos ORDER BY id_producto";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['id_producto']; ?></td>
                                <td><?php echo $row['nombre_producto']; ?></td>
                                <td class="text-center">
                                    <a type="button" onclick="editar_producto(<?php echo $row['id_producto']?>)" class="btn btn-secondary">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a type="button" onclick="eliminar_producto(<?php echo $row['id_producto']?>)" class="btn btn-danger">
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

        function limpiar_frm_productos(){
            if(confirm("¿Limpiar el formulario?")){
                var id_producto = document.getElementById("id_producto");
                var nombre_producto = document.getElementById("nombre_producto");
                id_producto.value = "";
                nombre_producto.value = "";
            }
        }

        function eliminar_producto(id){
            var nombre_producto = "";
            var encontrado = false;
            $.ajax({
                type: "POST",
                url: "productos_obtener.php",
                data: {id_producto:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_producto = data.nombre;
                    encontrado = true;
                    if(confirm("¿Eliminar el producto " + nombre_producto +"?")){
                        $.ajax({
                            type: "POST",
                            url: 'productos_eliminar.php',
                            data: {id_producto:id},
                            success: function (response) {
                                location.href='productos.php';
                            }
                        });
                    }
                }
            });
        }

        function editar_producto(id){
            var id_producto = document.getElementById("id_producto");
            var nombre_producto = document.getElementById("nombre_producto");
            id_producto.value = id;
            $.ajax({
                type: "POST",
                url: "productos_obtener.php",
                data: {id_producto:id},
                success: function(result) {
                    var data = $.parseJSON(result);
                    nombre_producto.value = data.nombre;
                }
            });
        }

        function guardar_producto(){
            var id_producto = document.getElementById("id_producto");
            var nombre_producto = document.getElementById("nombre_producto");
            if(nombre_producto.value == ""){
                alert("Debe ingresar un nombre de producto.");
                return;
            }
            if(id_producto.value == ""){
                if(confirm("¿Guardar el nuevo producto?")){
                    $.ajax({
                        type: "POST",
                        url: 'productos_nuevo.php',
                        data: $("#frm_productos").serialize(),
                        success: function (response) {
                            location.href='productos.php';
                        }
                    });
                }
            } else {
                if(confirm("¿Modificar el producto?")){
                    $.ajax({
                        type: "POST",
                        url: 'productos_modificar.php',
                        data: {id_producto:id_producto.value, nombre_producto:nombre_producto.value},
                        success: function (response) {
                            location.href='productos.php';
                        }
                    });
                }
            }
        }

    </script>

<?php include("footer.php") ?>
<?php include("db.php") ?>
<?php include("header.php") ?>

<!-- TITLE -->
<div class="row text-center">
    <h3>Recetas de Productos</h3>
</div>
<main class="container-fluid p-2">
    <div class="row">

        <div class="col-md-4">
            <!-- FORM -->
            <div class="card card-body">
                <form action="" name="frm_receta_productos" id="frm_receta_productos" method="POST">

                    
                    <div class="form-group">
                        <h4>Agregar materia prima a producto</h4>
                        <label for="id_materia_prima" class="form-label">ID:</label>
                        <input type="text" name="id_materia_prima" id="id_materia_prima" class="form-control" disabled>
                    </div>
                    
                    <div class="form-group">
                        <label for="id_materia_prima" class="form-label">Seleccione materia prima</label>

                        <select name=id_materia_prima id=id_materia_prima>
                            <option value="0">Materia prima</option>
                            <?php

                            $query = "SELECT nombre_materia_prima FROM materias_primas ORDER BY id_materia_prima ";
                            $result = mysqli_query($conn, $query);
                            while ($valores = mysqli_fetch_array($result)) {
                                echo '<option value="' . $valores["id_materia_prima"] . '">' . $valores["nombre_materia_prima"] . '</option>';
                            }
                            $id_materia_prima = $_POST["id_materia_prima"];
                            ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control" autofocus>
                    </div>


                    <div class="col-auto mt-2 text-center">
                        <button type="button" onclick="limpiar_frm_receta_productos()" class="btn btn-info btn-block">Limpiar</button>
                        <button type="button" onclick="guardar_receta_producto()" class="btn btn-success btn-block">Guardar</button>
                    </div>
                </form>
            </div>
        </div>








        <!-- TABLE -->
        <div class="col-md-8">

        <div class="form-group">
                            
                        <h5><label for="id_producto" class="form-label">Seleccione producto:</label>
                        <select name=id_producto id=id_producto>
                            <option value="0">Producto</option>
                            <?php

                            $query = "SELECT nombre_producto FROM productos ORDER BY id_producto";
                            $result = mysqli_query($conn, $query);
                            while ($valores = mysqli_fetch_array($result)) {
                                echo '<option value="' . $valores["id_producto"] . '">' . $valores["nombre_producto"] . '</option>';
                            }

                            $id_producto = $_POST["id_producto"];
                            ?>
                        </select></h5>

                    </div>
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
                    $query = "SELECT * FROM materias_primas_x_productos WHERE id_producto=$id_producto";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                    
                        $query2 = "SELECT nombre_materia_prima FROM materias_primas WHERE id_materia_prima= $id_materia_prima";
                        $result2 = mysqli_query($conn, $query2);
                        $nombre_materia_prima = mysqli_fetch_assoc($result2);
                    ?>
                        <tr>
                            <td><?php echo $id_producto; ?></td>
                            <td><?php echo $nombre_materia_prima; ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td class="text-center">
                                <a type="button" onclick="editar_receta_producto(<?php echo $row['id_producto'] ?>)" class="btn btn-secondary">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a type="button" onclick="eliminar_receta_producto(<?php echo $row['id_producto'] ?>)" class="btn btn-danger">
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
    

    function guardar_receta_producto() {
        var id_producto = document.getElementById("id_producto");
        var id_materia_prima = document.getElementById("id_materia_prima");
        var cantidad = document.getElementById("cantidad");

        if (nombre_producto.value == "") {
            alert("Debe seleccionar un producto.");
            return;
        }
        if (id_producto.value == "") {
            if (confirm("¿Guardar nueva receta?")) {
                $.ajax({
                    type: "POST",
                    url: 'recetas_productos_nuevo.php',
                    data: $("#frm_receta_productos").serialize(),
                    success: function(response) {
                        location.href = 'recetas_productos.php';
                    }
                });
            }
        } else {
            if (confirm("¿Modificar el producto?")) {
                $.ajax({
                    type: "POST",
                    url: 'recetas_productos_modificar.php',
                    data: {
                        id_producto: id_producto.value,
                        id_materia_prima: id_materia_prima.value,
                        cantidad: cantidad.value
                    },
                    success: function(response) {
                        location.href = 'recetas_productos.php';
                    }
                });
            }
        }
    }
</script>



<?php include("footer.php") ?>
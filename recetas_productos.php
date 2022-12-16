<?php include("db.php") ?>
<?php include("header.php") ?>
<?php
if (isset($_POST)) {
    $id_producto = $_POST['producto'];
    $id_materia_prima = $_POST['mp'];

}
?>





<!--FORM tabla -->
<form action="recetas_productos.php" name="frm_receta_productos" id="frm_receta_productos" method="POST">

    <!-- TITLE -->
    <div class="row text-center">
        <h3>Recetas de Productos</h3>
    </div>

    <main class="container-fluid p-2">
        <div class="row">


            <!-- TABLE -->
            <div class="form-group">
                <h5><label for="id_producto" class="form-label">Seleccione producto:</label>
                    <select name=producto onchange=this.form.submit()>
                        <option value="">Elige un producto</option>
                        <?php
                        $query = "SELECT * FROM productos ORDER BY id_producto";
                        $result = mysqli_query($conn, $query);
                        while ($valores = mysqli_fetch_array($result)) {
                            if ($_POST["producto"] == $valores['id_producto']) {
                                
                                echo '<option value="' . $valores['id_producto'] . '" selected>' . $valores['nombre_producto'] . '</option>';
                            }else{
                            echo '<option value="' . $valores['id_producto'] . '">' . $valores['nombre_producto'] . '</option>';}
                        }
                        ?>
                    </select>


                </h5>
            </div>


            <div class="col-md-4">
                <div class="card card-body">
                    <div class="form-group">
                        <h4>Agregar materia prima a producto</h4>
                    </div>
                    <div class="form-group">
                        <label for="nombre_materia_prima" class="form-label">Seleccione materia prima</label>
                        <select name=mp id=mp>
                            <option value="">Materia prima</option>
                            <?php
                            $query = "SELECT * FROM materias_primas ORDER BY id_materia_prima";
                            $result = mysqli_query($conn, $query);
                            while ($valores = mysqli_fetch_array($result)) {
                                if ($_POST["mp"] == $valores['id_materia_prima']) {
                                
                                    echo '<option value="' . $valores['id_materia_prima'] . '" selected>' . $valores['nombre_materia_prima'] . '</option>';
                                }else{
                                echo '<option value="' . $valores['id_materia_prima'] . '">' . $valores['nombre_materia_prima'] . '</option>';
                                }
                            }
                            ?>
                        </select>


                    </div>
                    <div class="form-group">
                        <label for="id_materia_prima">ID:</label>
                        <?php
                        echo $id_materia_prima;
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="text" name="cantidad" id="cantidad" class="form-control" autofocus>
                        <?php $cantidad = $_POST['cantidad'];
                        $GLOBALS['cantidad'] = $cantidad;
                        ?>
                    </div>
                    <div class="col-auto mt-2 text-center">
                        <button type="button" class="btn btn-info btn-block">Limpiar</button>

                        <input type="submit" name="btn_guardar" value="guardar" class="btn btn-success btn-block"><br>
                    </div>
                </div>
            </div>
            <?php

            if ($_POST['btn_guardar'] == 'guardar') {
                $query = "INSERT INTO `materias_primas_x_productos` (`id_producto`, `id_materia_prima`, `cantidad`) VALUES ('$id_producto', '$id_materia_prima', '$cantidad') ";
                $result = mysqli_query($conn, $query);
            }
            ?>

            <div class="col-md-8">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID Materia Prima</th>
                            <th class="text-center">Materia Prima</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM materias_primas_x_productos WHERE id_producto=$id_producto";
                        $result = mysqli_query($conn, $query);
                        $query1 = "SELECT nombre_producto FROM productos WHERE id_producto=$id_producto";
                        $result1 = mysqli_query($conn, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $nombre_p = $row1['nombre_producto'];

                        echo "<h5>Producto: $nombre_p<h5>";
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>

                                <td><?php echo $row['id_materia_prima']; ?></td>
                                <td><?php
                                    $id_materia_prima = $row['id_materia_prima'];
                                    $query2 = "SELECT nombre_materia_prima FROM materias_primas WHERE id_materia_prima=$id_materia_prima";
                                    $result2 = mysqli_query($conn, $query2);

                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        echo $row2['nombre_materia_prima'];
                                    } ?>
                                </td>
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

</form>



<?php include("footer2.php") ?>
<?php include("db.php") ?>
<?php include("header.php") ?>

<h2 align="center">REGISTRO DE COMPRAS</h2>

<hr>

<div class="container mt-3">

    <div class="row align-items-start">
        <!-- CARGA DE DATOS -->
        <div class="card col-md-4 mb-3 p-3">
            <form action="registrar_compras_nuevo.php" method="POST">
                <div class="mb-3">
                    <select class="form-select btn btn-secondary">
                        <option selected hidden>Elegir Proveedor</option>
                        <option class="text-start" name="nombre_proveedor" value="1">One</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <input type="date" name="fecha" id="fecha">
                </div>

                <div class="col-md-4 mb-3">
                    <input type="number" name="id_proveedor" id="id_proveedor" placeholder="id" disabled>
                </div>

                <div class="mb-3">
                    <select class="form-select" aria-label="Default select example">
                        <option selected hidden>Elegir M. Prima</option>
                        <option name="materia_prima" value="1">One</option>
                    </select>
                </div>

                <div class="mb-3">
                    <h5>
                        Cantidad:
                    </h5>
                    <input type="number" name="cantidad" id="cantidad">
                </div>
                <div class="mb-3">
                    <h5>
                        Costo:
                    </h5>
                    <input type="number" name="costo" id="costo">
                </div>
                <div>
                    <button name="registrar_compras_nuevo" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>

        <!-- LISTA TABLA -->
        <div class="col-md-8 mb-3">
            <table class="table table-bordered border-secondary">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Materia Prima</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        $query = "SELECT * FROM detalles_compras";
                        $result_compras = mysqli_query($conn, $query);

                        while($row = mysqli_fetch_array($result_compras)) { ?>

                    <tr>
                        <!-- ¡¡¡ REVISAR PARA Q TRAIGA REGISTROS DE LA BD !!! -->
                        <td scope="col"><?php echo $row['id']?></td>
                        <td scope="col"><?php echo $row['nombre_proveedor']?></td>
                        <td scope="col"><?php echo $row['materia_prima']?></td>
                        <td scope="col"><?php echo $row['cantidad']?></td>
                        <td scope="col"><?php echo $row['costo']?></td>
                        <td scope="col"><?php echo $row['fecha']?></td>
                        <td scope="col">
                            <a class="btn btn-secondary btn-sm" href="registrar_compras_modificar.php?id=<?php echo $row['id']?>"><i
                                    class="fas fa-pen-alt fa-lg"></i></a>
                            <a class="btn btn-danger btn-sm"
                                href="registrar_compras_eliminar.php?id=<?php echo $row['id']?>"><i
                                    class="fas fa-trash-alt fa-lg"></i></a>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</div>

<?php include("footer.php") ?>
<?php include("db.php") ?>
<?php include("header.php") ?>

<main class="container-fluid p-2">

    <!-- TITLE -->
    <div class="row text-center my-2">
        <h3>Listado de materias primas con stock crítico</h3>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-bordered table-secondary table-striped">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Materia prima</th>
                        <th class="text-center">Stock mínimo</th>
                        <th class="text-center">Stock actual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                            $query = "SELECT * FROM materias_primas WHERE stock_actual<=stock_minimo ORDER BY id_materia_prima";
                            $result = mysqli_query($conn, $query);    
                            while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id_materia_prima']; ?></td>
                        <td><?php echo $row['nombre_materia_prima']; ?></td>
                        <td class="text-end"><?php echo $row['stock_minimo']; ?></td>
                        <td class="text-end"><?php echo $row['stock_actual']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include("footer2.php") ?>
<?php include("db.php") ?>
<?php include("header.php") ?>


<hr class="border border-danger">
    <h3 class="text-danger text-center">LISTADO DE MATERIAS PRIMAS CON STOCK CRÍTICO<i class="text-warning fas fa-exclamation-triangle m-3"></i></h3>
    <hr class="border border-danger">

    <div class="container text-center">
        <div class="row my-5">
            <table class="table table-striped border-danger bg-danger" style="--bs-bg-opacity: .2;">
                <thead>
                    <tr>
                        <th>ID</th>    
                        <th>MATERIA PRIMA</th>
                        <th>STOCK MÍNIMO</th>
                        <th>STOCK ACTUAL</th>
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
                            <td><?php echo $row['stock_minimo']; ?></td>
                            <td><?php echo $row['stock_actual']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include("footer.php") ?>
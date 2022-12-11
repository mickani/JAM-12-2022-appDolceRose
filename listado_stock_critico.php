<?php include("db.php") ?>
<?php include("header.php") ?>

<hr class="border border-danger">
<h2 align="center" class="text-danger">LISTA STOCK CRÍTICO<i class="text-warning fas fa-exclamation-triangle m-3"></i></h2>
<hr class="border border-danger">

<div class="container text-center">
    <div class="row my-5">

        <table class="table table-striped border-danger bg-danger" style="--bs-bg-opacity: .2;">
            <thead>
                <tr>
                    <th>MATERIA PRIMA</th>
                    <th>STOCK</th>
                    <th>COSTO $</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="text-danger"><b>ej m. prima</b></p>
                    </td>
                    <td>
                        <p class="text-danger"><b>ej stock</b></p>
                    </td>
                    <td>
                        <p class="text-danger"><b>ej costo</b></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php include("footer.php") ?>
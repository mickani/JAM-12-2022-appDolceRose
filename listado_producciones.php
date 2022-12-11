<?php include("db.php") ?>
<?php include("header.php") ?>

<hr class="border border-warning">
<h2 align="center" class="text-warning">LISTA DE PRODUCCIONES</h2>
<hr class="border border-warning">

<div class="container text-center">
    <div class="row align-items-start border rounded p-3">
        <div class="col-6">
            <h5>Desde fecha</h5>
            <input type="date" name="desde_fecha" id="desde_fecha">
        </div>
        <div class="col-6">
            <h5>Hasta fecha</h5>
            <input type="date" name="hasta_fecha" id="hasta_fecha">
        </div>
        <div class="row align-items-center m-2">
            <div class="col">
                <button style="width:20%" class="btn btn-warning"><b>Buscar</b></button>
            </div>
        </div>
    </div>

    <div class="m-2">
        <table class="table table-striped bg-warning rounded" style="--bs-bg-opacity: .2;">
            <thead>
                <tr>
                    <th><b>PRODUCTO</b></th>
                    <th><b>CANTIDAD</b></th>
                    <th><b>COSTO UNITARIO $</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="text-dark"><b>ej producto</b></p>
                    </td>
                    <td>
                        <p class="text-dark"><b>2</b></p>
                    </td>
                    <td>
                        <p class="text-dark"><b>200</b></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include("footer.php") ?>
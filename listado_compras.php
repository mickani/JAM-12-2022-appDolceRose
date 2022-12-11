<?php include("db.php") ?>
<?php include("header.php") ?>

<hr class="border border-success">
<h2 align="center" class="text-success">LISTA DE COMPRAS</h2>
<hr class="border border-success">

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
                <button style="width:20%" class="btn btn-success"><b>Buscar</b></button>
            </div>
        </div>
    </div>

    <div class="m-2">
        <table class="table table-striped bg-success rounded" style="--bs-bg-opacity: .2;">
            <thead>
                <tr>
                    <th><b>MATERIA PRIMA</b></th>
                    <th><b>CANTIDAD</b></th>
                    <th><b>COSTO $</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p class="text-dark"><b>ej m. prima</b></p>
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
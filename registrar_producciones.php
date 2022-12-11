<?php include("db.php") ?>
<?php include("header.php") ?>

<h2 align="center">REGISTRO DE PRODUCCIÓN</h2>
<div class="container text-center">
    <div class="row align-items-start border border-secondary rounded">
        <div class="col p-2">
            <h5>Producto</h5>
            <select class="form-select" aria-label="Default select example">
                <option value="1">One</option>
            </select>
        </div>
        <div class="col p-2">
            <h5>Fecha:</h5>
            <input class="form-control" type="date" name="fecha" id="fecha">
        </div>
        <div class="col p-2">
            <h5>Cantidad:</h5>
            <input class="form-control" type="number" name="cantidad" id="cantidad">
        </div>
        <div class="row align-items-center m-2">
        <div class="col">
            <button style="width:10%" class="btn btn-primary text-white"><b>Ok</b></button>
        </div>
    </div>
    </div>
    
   
    <div class="row align-items-start my-5">
            <ul class="list-group">
                <li class="rounded p-2 list-group-item-light border-bottom border-info d-flex justify-content-between align-items-center">
                    <b>Ejemplo 1</b><b>../../..</b>
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <li class="rounded p-2 list-group-item-light border-bottom border-info d-flex justify-content-between align-items-center">
                    <b>Ejemplo 2</b><b>../../..</b>
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
            </ul>
    </div>
</div>

<?php include("footer.php") ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <link rel="stylesheet" href="estilos.css">
    <title>Dolce Rose</title>
    <!-- Bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- FONT AWESOME 5.6.3 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark px-4">
            <a href="index.php" class="navbar-brand logo-nav">DOLCE ROSE</a>
            <div id="navbarNav"> 
                <ul class="navbar-nav gap-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="materias_primas.php">Materias Primas</a></li>
                            <li><a class="dropdown-item" href="productos.php">Productos</a></li>
                            <li><a class="dropdown-item" href="proveedores.php">Proveedores</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="recetas_productos.php">Recetas de Productos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Transacciones</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="registrar_compras.php">Registrar Compras</a></li>
                            <li><a class="dropdown-item" href="registrar_producciones.php">Registrar Producciones</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Listados</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="listado_compras.php">Listado de Compras por fechas</a></li>
                            <li><a class="dropdown-item" href="listado_producciones.php">Listado de Producciones por fechas</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="listado_stock_critico.php">Listado de Materias Primas con Stock Crítico</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
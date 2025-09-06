<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Administrador</title>
</head>
<?php
require_once __DIR__ . '/../../../config/app.php';
$url = SERVERURL;
?>
<body>


    <header>
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand text-decoration-none ml-1" style="margin-left: 10px;"
                    href="<?php echo $url; ?>/app/views/index.php"><img src="<?php echo $url; ?>/public/img/logoo.png"
                        height="70" width="
                " /></a>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Botones centrados -->
                    <ul class="navbar-nav mx-auto">
                        <div class='d-flex justify-content-center'>
                            <!-- Gestion de Empresas -->
                            <div class="dropdown p-1 m-1">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Gestion de Empresas
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/AltasEmpresa.php">Dar de Alta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/BajasEmpresa.php">Dar de Baja</a></li>
                                </ul>
                            </div>

                            <!-- Gestion de Postulantes -->
                            <div class="dropdown p-1 m-1">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Gestion de Postulantes
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/AltasPostulante.php">Dar de Alta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/BajasPostulante.php">Dar de Baja</a></li>
                                </ul>
                            </div>

                            <!-- Gestion de Autoridades Salesianas -->
                            <div class="dropdown p-1 m-1">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Gestion de Autoridad
                                </button>
                                <ul class="dropdown-menu ">
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/AltasAut.php">Dar de Alta</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/admin/BajasAutoridad.php">Dar de Baja</a></li>
                                </ul>
                            </div>
                        </div>
                    </ul>
                    
                    <!-- Botón "Cerrar Sesión" a la derecha -->
                    <div class='d-flex justify-content-center'>
                    <a href="<?php echo $url; ?>/app/views/cerrarsesion.php">
                            <button class='btn-secondary button border-0' type='submit'>Cerrar Sesion</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


</body>

</html>


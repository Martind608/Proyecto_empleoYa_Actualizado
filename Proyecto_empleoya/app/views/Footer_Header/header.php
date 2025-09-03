<?php
$url="http://".$_SERVER['HTTP_HOST']."/Proyecto_empleoya/Proyecto_empleoya"

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?php echo $url; ?>/public/style/style.css">

    <title><?= $title ?? 'Empleo Ya!' ?></title>
</head>

<body>


    <header>
        <nav class="navbar navbar-expand-lg bg-light ">
            <div class="container-fluid d-flex justify-content-center">
                <div class="row align-items-center flex-column p-1 m-1">
                    <div class="col text-center">
                       <a class="navbar-brand p-0 m-0" href="<?php echo $url; ?>/public/index.php">Empleo Ya!</a>
                    </div>
                    <div class="col text-center">
                        <img src="<?php echo $url; ?>/public/img/iconoJuan23.png" height="50" width="50">
                    </div>
                </div>  

                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav ms-auto ">
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
                            <a href="<?php echo $url; ?>/app/views/login.php">
                                <button class='button border-0' type='submit'>Iniciar Sesion</button>
                            </a>

                            <!-- DROPDOWN Crear Cuenta -->
                            <div class="dropdown">
                                <button class="button border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Crear Cuenta
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/Postulante/Registropostulante.php">Postulante</a></li>
                                    <li><a class="dropdown-item" href="<?php echo $url; ?>/app/views/Empresa/Registroempresa.php">Empresa</a></li>
                                </ul>
                            </div>
                            
                        </div>              
                    </ul>
                </div>

                <!-- CERRAR SESION Button -->
                <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto ">
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
                            <form id="Cerrarsesion-form" action="cerrarsesion.php" method="post">
                                <button class='btn-secondary button border-0' type='submit'>Cerrar Sesión</button>
                            </form>
                        </div>
                    </ul>
                </div> -->
        </nav>
    </header>

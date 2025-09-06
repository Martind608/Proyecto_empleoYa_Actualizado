<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
      
     <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Index</title>
</head>

<body>

<?php
$url="http://".$_SERVER['HTTP_HOST']."/Proyecto_empleoya/Proyecto_empleoya"

?>
    <header >
        <nav class="navbar navbar-expand-lg  p-0">
                <a class="navbar-brand text-decoration-none ml-1" style="margin-left: 10px;" 
                href="<?php echo $url; ?>/app/views/index.php"><img src="<?php echo $url; ?>/public/img/logoo.png" height="70" 
                width="
                " /></a>
                

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
               
                <div class="collapse navbar-collapse" id="navbarNav">
                    
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
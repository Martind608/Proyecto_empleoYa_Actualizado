<?php
$url="http://".$_SERVER['HTTP_HOST']."/Proyecto_empleoya/Proyecto_empleoya";
require_once __DIR__ . '/../../../config/csrf.php';
$csrf_token = csrf_token();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="<?php echo $url; ?>/public/style/style.css">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('form').forEach(function(form) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'csrf_token';
            input.value = '<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, "UTF-8"); ?>';
            form.appendChild(input);
        });
    });
    </script>
    <title><?= $title ?? 'Empleo Ya!' ?></title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <div class="row align-items-center flex-column p-1 m-1">
                    <div class="col text-center">
                    <a class="navbar-brand p-0 m-0" href="<?php echo $url; ?>/public/index.php">Empleo Ya!</a>
                    </div>
                    <div class="col text-center">
                        <img src="<?php echo $url; ?>/public/img/iconoJuan23.png" height="50" width="50">
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Botones centrados -->
                    <ul class="navbar-nav mx-auto">
                        <div class='d-flex justify-content-center'>
                            <a href="<?php echo $url; ?>/app/views/Empresa/PostularTrabajo.php">
                                <button class='btn-secondary button border-0 m-1'>
                                    Publicar Oferta
                                </button>
                            </a>
                            
                            <a href="<?php echo $url; ?>/app/views/Empresa/Mispropuestas.php">
                                <button class='btn-secondary button border-0 m-1'>
                                    Mis Propuestas
                                </button>
                            </a>
                            
                            <button class='btn-secondary button border-0 m-1' type="button" data-bs-toggle="modal" data-bs-target="#configuracion">
                                Notificaciones
                            </button>
                            
                            <!-- MODAL Ventana Emergente -->
                            <div class="modal fade" id="configuracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                            <div class="modal-header d-flex justify-content-center">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    Pulse aceptar para desactivar las notificaciones
                                                </h1>
                                            </div>
                
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                            </div>
                                            
                                    </div>
                                </div>
                            </div>
                
                        </div>
                    </ul>
                    
                    <!-- Botón "Cerrar Sesión" a la derecha -->
                    <div class='ml-auto'>
                        <a href="<?php echo $url; ?>/app/views/Empresa/EditarEmpresa.php">
                                <button class='btn-secondary button border-0 m-1' type='submit'>Editar Datos</button>
                        </a>
                        <a href="<?php echo $url; ?>/app/views/cerrarsesion.php">
                            <button class='btn-secondary button border-0' type='submit'>Cerrar Sesion</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

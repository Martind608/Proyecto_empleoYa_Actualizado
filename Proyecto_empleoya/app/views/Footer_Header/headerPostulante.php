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
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
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
        <nav class="navbar navbar-expand-lg navbar-gradient">
            <div class="container-fluid">
                <a class="navbar-brand p-0 m-0" href="<?php echo $url; ?>/public/index.php">
                    <img src="<?php echo $url; ?>/public/img/EmpleoYa.png" alt="Empleo Ya" height="50">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Abrir menú">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Botón "Cerrar Sesión" a la derecha -->
                    <div class='d-flex justify-content-end'>
                        <a href="<?php echo $url; ?>/app/views/Postulante/EditarPostulante.php">
                                <button class='btn-secondary button border-0 m-1' type='submit'>Editar Datos</button>
                        </a>
                        <a href="<?php echo $url; ?>/app/views/cerrarsesion.php">
                            <button class='btn-secondary button border-0 m-1' type='submit'>Cerrar Sesion</button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

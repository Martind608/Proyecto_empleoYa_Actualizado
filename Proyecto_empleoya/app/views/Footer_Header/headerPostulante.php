<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Postulante</title>
</head>
<?php
require_once __DIR__ . '/../../../config/app.php';
$url = SERVERURL;
?>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand text-decoration-none ml-1" style="margin-left: 10px;" href="<?php echo $url; ?>/public/index.php"><img
                    src="<?php echo $url; ?>/public/img/logoo.png" height="70" width="
                " /></a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- class='collapse navbar-collapse' -->
                <div class="ms-auto" id="navbarNav">
                    <div class='d-flex justify-content-center'>
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
</body>

</html>
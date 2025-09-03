<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Inicio Autoridad</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light ">
            <div class="container-fluid d-flex justify-content-center p-2 m-2">
                <div class="row align-items-center flex-column p-1 m-1">
                    <div class="col text-center">
                        <a class="navbar-brand p-0 m-0" href="../../views/index.php">Empleo Ya!</a>
                    </div>
                    <div class="col text-center">
                        <img src="../../../public/img/iconoJuan23.png" height="50" width="50">
                    </div>
                </div> 

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">¿Quienes Somos?</a>
                    </li>
                </ul>  -->

                    <ul class="navbar-nav ms-auto ">
                        <div class='d-flex justify-content-center gap-15 align-items-center'>

                            <a href="../../views/index.php">
                                <button class='btn-secondary button border-0' type='submit'>Cerrar Sesion</button>
                            </a>

                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center flex-column align-items-center'>
                <h1>Inicio Autoridad Salesiana</h1>
                <h2>Estadisticas</h2>
            </div>

            <div class='d-flex justify-content-center p-1 m-1'>
                <a href="../../views/Autoridad/EstadisticasPostulante.php">
                    <div class='btn button m-1'>
                        <h1>Postulantes</h1>
                    </div>
                </a>

                <a href="../../views/Autoridad/EstadisticasEmpresa.php">
                    <div class='btn button m-1'>
                        <h1>Empresa</h1>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <footer class='py-4 footer'>
        <div class='row'>
            <div class='col-12'>
                <p class='text-center mb-0 text-white'>&copy; 2023: Desarrollado por Juan23</p>
            </div>
        </div>
    </footer>
</body>

</html>
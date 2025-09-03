<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../public/style/style.css">

    <title>Inicio Sesion</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light ">
            <div class="container-fluid d-flex justify-content-center p-2 m-2">
                <div class="row align-items-center flex-column p-1 m-1">
                    <div class="col text-center">
                        <a class="navbar-brand p-0 m-0" href="../views/index.php">Empleo Ya!</a>
                    </div>
                    <div class="col text-center">
                        <img src="../../public/img/iconoJuan23.png" height="50" width="50">
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">
                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">¿Quienes Somos?</a>
                </li>
            </ul>  -->

                    <!-- DROPDOWN Crear Cuenta -->
                    <div class="dropdown">
                        <button class="button border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Crear Cuenta
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="../../app/views/Postulante/Registropostulante.php">Postulante</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="../../app/views/Empresa/Registroempresa.php">Empresa</a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Iniciar Sesion</h3>
                    <form action="../controllers/UsuarioControlador.php" method="POST"
                        class='d-flex flex-column gap-15'>
                        <Input class="form-control" type='Email' name='Email' placeholder='Email' />
                        <Input class="form-control" type='HashConstrasenia' name='HashConstrasenia'
                            placeholder='Contraseña' />
                        <p class="btn">Olvidaste tu contraseña?</p>
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
                            <button class='button border-0' type='submit'>Iniciar Sesion</button>
                            <input type="hidden" name="FROM_LOGIN" value="true">
                        </div>
                    </form>
                </div>
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
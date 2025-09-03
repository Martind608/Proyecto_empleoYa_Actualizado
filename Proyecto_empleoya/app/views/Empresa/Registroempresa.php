<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Registro Empresa</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light p-3 pt-0">
            <div class="container-fluid">
                <div class="row align-items-center flex-column p-1 m-1">
                    <div class="col text-center">
                        <a class="navbar-brand p-0 m-0" href="../../../app/views/index.php">Empleo Ya!</a>
                    </div>
                    <div class="col text-center">
                        <img src="../../../public/img/iconoJuan23.png" height="50" width="50">
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                            <a href="../../views/login.php">
                                <button class='button border-0' type='submit'>Iniciar Sesion</button>
                            </a>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Registro Empresa</h3>
                    <form action="../../controllers/RegistroEmpresaControlador.php" method="post"
                        class='d-flex flex-column gap-15'>
                        <input class='form-control' type='text' name='RazonSocial' placeholder='Razon Social' />
                        <input class='form-control' type='text' name='SitioWeb' placeholder='Sitio Web' />
                        <input class='form-control' type='number' name='CUIT' placeholder='CUIT' />
                        <input class='form-control' type='text' name='ciudad' placeholder='Ciudad' />

                        <input class='form-control' type='text' name='email' placeholder='Correo Electronico' />
                        <input class='form-control' type='password' name='password' placeholder='Contraseña' />
                        <input class='form-control' type='number' name='telefono' placeholder='Telefono' />

                        <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                            <button class='button border-0' type='submit'>Crear Cuenta</button>
                        </div>

                        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content ">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Cuenta Creada Correctamente
                                        </h1>
                                    </div>

                                    <div class="modal-body d-flex justify-content-center">
                                        <p>Recibira un mail cuando su cuenta se haya dado de alta</p>
                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Aceptar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class='p-1'>
            <a href="../../views/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
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
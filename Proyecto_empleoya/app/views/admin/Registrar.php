<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Registrar Administrador</title>
</head>

<body>
    <header class=''>
        <nav class="navbar navbar-expand-lg bg-light p-3 pt-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Empleo Ya!</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Registrar Administrador</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Registro Administrador</h3>
                    <form action="../../controllers/RegistroAdmControlador.php" method="post"
                        class='d-flex flex-column gap-15'>
                        <input class='form-control' type='text' name='email' placeholder='Correo Electronico' />
                        <input class='form-control' type='password' name='password' placeholder='Contraseña' />
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
    </section>

<?php require_once '../Footer_Header/footer.php'; ?>
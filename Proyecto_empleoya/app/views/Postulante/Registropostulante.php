<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">
    <title>Registro Postulante</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg  ">
        <a class="navbar-brand text-decoration-none ml-1" style="margin-left: 10px;" href="../../../app/views/index.php"><img
                    src="../../../public/img/logoo.png" height="70" width="
                " /></a>


                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarNav">


                    <ul class="navbar-nav ms-auto ">
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
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
        <div class='row w-100'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Registro Postulante</h3>
                    <form action="../../controllers/RegistroPostulanteControlador.php" method="post"
                        class='d-flex flex-column gap-15'>
                        <input class='form-control' type='text' name='nombre' placeholder='Nombre' required />
                        <input class='form-control' type='text' name='apellido' placeholder='Apellido' required />
                        <input class='form-control' type='number' name='DNI' placeholder='DNI' required />
                        <input class='form-control' type='number' name='telefono' placeholder='Telefono' required />
                        <input class='form-control' type='text' name='ciudad' placeholder='Ciudad' required />
                        <input class='form-control' type='email' name='email' placeholder='Email' required />
                        <input class='form-control' type='text' name='password' placeholder='Contraseña' required />


                        <div>
                            <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                                <button class='button border-0' type='submit'>Crear Cuenta</button>
                            </div>
                        </div>

                        <?php

                        if (isset($_SESSION['Registroexitoso']) && $_SESSION['Registroexitoso'] === true) {

                            ?>
                            <div class="modal fade" id="Registroexitoso" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#Registroexitoso').modal('show');
                                });
                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['Registroexitoso'] = false;
                        }
                        ?>

                        <?php
                        //Ventana emergente  de Error en Registro  (Email ya usado)
                        if (isset($_SESSION['Registroincorrecto']) && $_SESSION['Registroincorrecto'] === true) {

                            ?>
                            <div class="modal fade" id="Registroincorrecto" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Error al crear la cuenta
                                            </h1>
                                        </div>

                                        <div class="modal-body d-flex justify-content-center">
                                            <p>Error en el registro de postulante. El correo electrónico ya existe.</p>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Aceptar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#Registroincorrecto').modal('show');
                                });
                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['Registroincorrecto'] = false;
                        }
                        ?>

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

    <!-- FOOTER -->
    <?php
    require_once "../Footer_Header/footer.php";
    ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../public/style/style.css">


    <title>Inicio Sesion</title>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg  p-0">
            <a class="navbar-brand text-decoration-none ml-1" style="margin-left: 10px;" href="../views/index.php"><img
                    src="../../public/img/logoo.png" height="70" width="
                " /></a>


                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                    </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav ms-auto ">
                    <div class='d-flex justify-content-center gap-15 align-items-center'>


                        <!-- DROPDOWN Crear Cuenta -->
                        <div class="dropdown p-1">
                            <button class="button border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Crear Cuenta
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="../../app/views/Postulante/Registropostulante.php">Postulante</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="../../app/views/Empresa/Registroempresa.php">Empresa</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </ul>
            </div>

        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2 '>
        <div class='row w-100'>
            <div class='col-12 '>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Iniciar Sesion</h3>
                    <form action="../controllers/UsuarioControlador.php" method="POST"
                        class='d-flex flex-column gap-15'>
                        <input class="form-control" type='Email' name='Email' placeholder='Email' required />
                        <input class="form-control" type='HashConstrasenia' name='HashConstrasenia'
                            placeholder='Contraseña' required />
                        <!-- <p class="btn" data-bs-toggle="modal" data-bs-target="#ContactModal">Olvidaste tu contraseña?
                        </p> -->
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
                            <button class='button border-0' type='submit'>Iniciar Sesion</button>
                            <input type="hidden" name="FROM_LOGIN" value="true">
                        </div>

                        <?php

                        // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                        if (isset($_SESSION['credencialesincorrectas']) && $_SESSION['credencialesincorrectas'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="credencialesincorrectas" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Credenciales incorrectas.
                                                Vuelva a intentar.</h1>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary text-white"
                                                data-bs-dismiss="modal">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#credencialesincorrectas').modal('show');
                                });

                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['credencialesincorrectas'] = false;
                        }

                        // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                        if (isset($_SESSION['credencialnoverificada']) && $_SESSION['credencialnoverificada'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="credencialnoverificada" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content ">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5 d-flex align-items-center" id="exampleModalLabel">
                                                Espere a que el administrador verifique sus datos.</h1>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary text-white"
                                                data-bs-dismiss="modal">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#credencialnoverificada').modal('show');
                                });

                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['credencialnoverificada'] = false;
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['Dadodebajaempresa']) && $_SESSION['Dadodebajaempresa'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="Dadodebajaempresa" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Usted se ha dado de baja de
                                                la bolsa de empleo </h1>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#Dadodebajaempresa').modal('show');
                                });

                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['Dadodebajaempresa'] = false;
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['Dadodebajapostulante']) && $_SESSION['Dadodebajapostulante'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="Dadodebajapostulante" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Usted se ha dado de baja de
                                                la bolsa de empleo </h1>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#Dadodebajapostulante').modal('show');
                                });

                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['Dadodebajapostulante'] = false;
                        }
                        ?>

<?php
                        if (isset($_SESSION['Usuariodadodebaja']) && $_SESSION['Usuariodadodebaja'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="Usuariodadodebaja" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Este usuario con el que intentas ingresar a sido dado de baja de la bolsa de empleos </h1>

                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                $(document).ready(function () {
                                    $('#Usuariodadodebaja').modal('show');
                                });

                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['Usuariodadodebaja'] = false;
                        }
                        ?>
                    </form>
                </div>



            </div>
        </div>
    </section>

    <!-- MODAL (Ventana Emergente) -->
    <div class="modal fade" id="ContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comuníquese en alguna de estas redes:</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Siga nuestras redes sociales:</p>
                    <ul>
                        <li><a href="https://instagram.com/juan23.edu.ar?igshid=YmMyMTA2M2Y="
                                target="_blank">Instagram</a></li>
                        <li><a href="https://www.facebook.com/Juan23.ar" target="_blank">Facebook</a></li>
                    </ul>
                    <p>Contáctenos por correo electrónico:</p>
                    <ul>
                        <li><a href="mailto:secretaria@juan23.edu.ar">secretaria@juan23.edu.ar</a></li>
                        <li><a href="mailto:consultas@unisal.edu.ar">consultas@unisal.edu.ar</a></li>
                    </ul>
                    <p>Llámenos al siguiente número de teléfono:</p>
                    <ul>
                        <li>(0291) 4562117</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER -->
    <?php
    require_once "Footer_Header/footer.php";
    ?>



</body>

</html>
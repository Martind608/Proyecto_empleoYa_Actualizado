<?php
session_start();
?>
<?php
require_once "../Footer_Header/headerPostulante.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Editar Perfil Postulante</h3>
                    <form action='../../controllers/Editar_PerfilPostulante.php' method='POST'
                        class='d-flex flex-column gap-15' enctype="multipart/form-data">
                        <?php
                        // Mostrar los datos actuales del usuario
                        // session_start();
                        require_once '../../../config/database.php'; // Agrega esta línea para incluir la configuración
                        require_once '../../controllers/UsuarioControlador.php'; // Agrega esta línea para incluir el controlador
                        
                        $db = new Database();
                        $usuarioModelo = new UsuarioModelo($db);
                        $controller = new UsuarioControlador($usuarioModelo);

                        $email = $_SESSION['Email'];
                        $datosUsuario = $controller->obtenerDatosUsuario($email);
                        $datosPostulante = $controller->obtenerDatosPostulante($datosUsuario['ID']);
                        $idContactoPostulante = $datosPostulante['IDContacto'];
                        $datosContactoPostulante = $controller->obtenerDatosContacto($idContactoPostulante);

                        if ($datosUsuario && $datosPostulante && $datosContactoPostulante) {
                            ?>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input class='form-control' type='text' name='Nombre' required
                                    value='<?php echo $datosPostulante['Nombre']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Apellido:</label>
                                <input class='form-control' type='text' name='Apellido' required
                                    value='<?php echo $datosPostulante['Apellido']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="Telefono" class="form-label">Telefono:</label>
                                <input class='form-control' type='number' name='Telefono' required
                                    value='<?php echo $datosContactoPostulante['Telefono']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="DNI" class="form-label">DNI:</label>
                                <input class='form-control' type='number' name='DNI' required
                                    value='<?php echo $datosPostulante['DNI']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="Ciudad" class="form-label">Ciudad:</label>
                                <input class='form-control' type='text' name='Ciudad' required
                                    value='<?php echo $datosContactoPostulante['Ciudad']; ?>' />
                            </div>
                            <!-- <div class="mb-3">
                               <label for="nombre" class="form-label">Fecha de Nacimiento:</label>
                               <input class='form-control' type='text' name='Fecha de Nacimiento'  value='' />
                           </div> -->

                            <div class="mb-3">
                                <label for="Email" class="form-label">Email:</label>
                                <input class='form-control' type='email' name='Email' required
                                    value='<?php echo $datosContactoPostulante['Email']; ?>' />
                            </div>



                            <?php
                        }
                        ?>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input class='form-control' type='password' name='password' id="password"
                                placeholder='Contraseña' />
                        </div>
                        <label class="d-flex justify-content-center btn-secondary button border-0">
                            Cargar CV
                            <input type="file" id="cv" name="cv" accept=".pdf" style="display: none;">
                        </label>

                        <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                            <button class='btn-secondary button border-0' type='submit'>Guardar Cambios</button>
                        </div>


                        <!-- <a href="../../controllers/AutoBajacontrolador.php?IDUsuario=<? // $datosUsuario['ID'] ?>&accion=dardebajapostulante"
                            class="btn btn-danger border-0 text-white">Darse de baja</a> -->
                            <a href="#" onclick="mostrarModalBaja(<?= $datosUsuario['ID'] ?>)"
                            class="btn btn-danger border-0 text-white">Darse de baja</a>


                        <?php
                        // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                        if (isset($_SESSION['exito_actualizacion']) && $_SESSION['exito_actualizacion'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Perfil Modificado
                                                Correctamente</h1>
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
                                    $('#modal').modal('show');
                                });
                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['exito_actualizacion'] = false;
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Error al editar los datos
                                            </h1>
                                        </div>

                                        <div class="modal-body d-flex justify-content-center">
                                            <p>Error al editar los datos del postulante. El correo electrónico ya existe.</p>
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

                        <?php
                        // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                        if (isset($_SESSION['errorcv']) && $_SESSION['errorcv'] === true) {

                            ?>
                            <!-- MODAL (Ventana Emergente) -->
                            <div class="modal fade" id="errorcv" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Error el CV a excedido el
                                                limite permitido 5MB</h1>
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
                                    $('#errorcv').modal('show');
                                });
                            </script>
                            <?php
                            // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                            $_SESSION['errorcv'] = false;
                        }
                        ?>
                </div>
            </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="confirmacionbaja" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">¿Está seguro de que quiere darse de
                                baja?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form id="confirmacionBajaForm" action="../../controllers/AutoBajacontrolador.php"
                                method="GET">
                                <input type="hidden" name="accion" value="dardebajapostulante">
                                <input type="hidden" name="IDUsuario" value="">

                                <button type="submit" class="btn btn-primary border-0">Aceptar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                // Función para mostrar el modal de confirmación de baja y establecer el IDUsuario
                function mostrarModalBaja(IDUsuario) {
                    // Abre el modal
                    $('#confirmacionbaja').modal('show');
                    // Establece el valor de IDUsuario en el formulario de confirmación
                    document.getElementById('confirmacionBajaForm').elements['IDUsuario'].value = IDUsuario;
                }

                // Función para enviar el formulario de confirmación de baja
                function enviarFormularioBaja() {
                    // Cierra el modal de confirmación
                    $('#confirmacionbaja').modal('hide');

                    // Envía el formulario de confirmación al controlador
                    document.getElementById('confirmacionBajaForm').submit();
                }
            </script>

        </div>
        <div class='p-1'>
            <a href="<?php echo $url; ?>/app/views/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
        </div>
    </div>
    </div>

    </div>

</section>

<!-- FOOTER -->
<?php
require_once "../Footer_Header/footer.php";
?>
</body>

</html>
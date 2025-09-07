<?php
session_start();
?>

<?php
require_once "../Footer_Header/headerAutoridad.php";;
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-6 offset-md-3'>
                    <div class='auth-card'>
                        <h3 class='text-center mb-3'>Editar Perfil Autoridad</h3>
                        <?php
                            // Verifica si existe una variable de sesión de error y muestra el mensaje de error si es así
                            if (isset($_SESSION['error_registro_autoridad'])) {
                                echo "<div class='alert alert-danger'>" . $_SESSION['error_registro_autoridad'] . "</div>";
                                // Luego, borra la variable de sesión de error para que el mensaje no se muestre en futuras visitas
                                unset($_SESSION['error_registro_autoridad']);
                            }
                    ?>
                        <form action='../../controllers/EditarPerfilAutoridad.php' method='POST'
                            class='d-flex flex-column gap-15'>
                            <?php
                            // Mostrar los datos actuales del usuario
                            /* session_start(); */
                            require_once '../../../config/database.php'; // Agrega esta línea para incluir la configuración
                            require_once '../../controllers/UsuarioControlador.php'; // Agrega esta línea para incluir el controlador

                            $db = new Database();
                            $usuarioModelo = new UsuarioModelo($db);
                            $controller = new UsuarioControlador($usuarioModelo);

                            $email = $_SESSION['Email'];
                            $datosUsuario = $controller->obtenerDatosUsuario($email);
                            $datosAutoridad = $controller->obtenerDatosAutoridad($datosUsuario['ID']);
                            $idContactoAutoridad = $datosAutoridad['IDContacto'];
                            $datosContactoAutoridad = $controller->obtenerDatosContacto($idContactoAutoridad);

                            if ($datosUsuario && $datosAutoridad && $datosContactoAutoridad) {
                                ?>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input class='form-control' type='text' name='Nombre' id="nombre" required
                                    value='<?php echo $datosAutoridad['Nombre']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Apellido:</label>
                                <input class='form-control' type='text' name='Apellido'id="apellido" required
                                    value='<?php echo $datosAutoridad['Apellido']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input class='form-control' type='text' name='ciudad' id="ciudad" required
                                    value='<?php echo $datosContactoAutoridad['Ciudad']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input class='form-control' type='number' name='telefono' id="telefono" required
                                    value='<?php echo $datosContactoAutoridad['Telefono']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input class='form-control' type='email' name='email' id="email" required
                                    value='<?php echo $datosContactoAutoridad['Email']; ?>' />
                            </div>

                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <label for="password" class="form-label" >Contraseña</label>
                                <input class='form-control' type='password' name='password' id="password" required 
                                    placeholder='Contraseña' />
                            </div>

                            <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                                <!-- SE MODIFICO type='submit' a type='button' para que funcione el modal (ventana emergente) -->
                                <!-- <button class='button border-0' data-bs-toggle="modal" data-bs-target="#modal" type='submit'>Guardar Cambios</button> -->
                                 <button class='btn-secondary button border-0' type='submit'>Guardar cambios</button>
                            </div>

                            <!-- MODAL (Ventana Emergente)
                            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Perfil Modificado Correctamente</h1>
                                        </div>
        
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type='submit' class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> -->
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
                                <input type="hidden" name="accion" value="dardebajaempresa">
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
                <a href="<?php echo $url; ?>public/index.php">
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
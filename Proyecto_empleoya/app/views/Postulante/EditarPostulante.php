<?php
session_start();
?>
<?php 
require_once "../Footer_Header/headerPostulante.php";
?>






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
                                <input class='form-control' type='text' name='Nombre'
                                    value='<?php echo $datosPostulante['Nombre']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Apellido:</label>
                                <input class='form-control' type='text' name='Apellido'
                                    value='<?php echo $datosPostulante['Apellido']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="Telefono" class="form-label">Telefono:</label>
                                <input class='form-control' type='text' name='Telefono'
                                    value='<?php echo $datosContactoPostulante['Telefono']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="DNI" class="form-label">DNI:</label>
                                <input class='form-control' type='text' name='DNI'
                                    value='<?php echo $datosPostulante['DNI']; ?>' />
                            </div>
                            <div class="mb-3">
                                <label for="Ciudad" class="form-label">Ciudad:</label>
                                <input class='form-control' type='text' name='Ciudad'
                                    value='<?php echo $datosContactoPostulante['Ciudad']; ?>' />
                            </div>
                            <!-- <div class="mb-3">
                               <label for="nombre" class="form-label">Fecha de Nacimiento:</label>
                               <input class='form-control' type='text' name='Fecha de Nacimiento'  value='' />
                           </div> -->
                            <!-- <div class="mb-3">
                               <label for="Numero de Libreta" class="form-label">Numero de Libreta:</label>
                               <input class='form-control' type='text' name='Numero de Libreta'  value='' />
                           </div> -->
                            <div class="mb-3">
                                <label for="Email" class="form-label">Email:</label>
                                <input class='form-control' type='text' name='Email'
                                    value='<?php echo $datosContactoPostulante['Email']; ?>' />
                            </div>

                            <!-- CARGAR CV -->

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
                                <input type="file" id="cv" name="cv" style="display: none;">
                            </label>

                            <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                                <button class='btn-secondary button border-0' type='submit'>Modificar</button>
                            </div>
                            <?php
                            // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                                if (isset($_SESSION['exito_actualizacion']) && $_SESSION['exito_actualizacion'] === true) {
                                    
                                    ?>
                                    <!-- MODAL (Ventana Emergente) -->
                                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Perfil Modificado Correctamente</h1>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                        $(document).ready(function() {
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
            </div>
            </form>
        </div>
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
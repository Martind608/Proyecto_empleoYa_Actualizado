<?php
session_start();
?>
<?php
    require_once "../Footer_Header/headerEmpresa.php";
?>


    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='container'>
            <div class='row'>
                <div class='col-md-6 offset-md-3'>
                    <div class='auth-card'>
                        <h3 class='text-center mb-3'>Editar Perfil Empresa</h3>
                        <form action='../../controllers/Editar_PerfilEmpresa.php' method='POST'
                            class='d-flex flex-column gap-15'>
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
                            $datosEmpresa = $controller->obtenerDatosEmpresa($datosUsuario['ID']);
                            $idContactoEmpresa = $datosEmpresa['IDContacto'];
                            $datosContactoEmpresa = $controller->obtenerDatosContacto($idContactoEmpresa);

                            if ($datosUsuario && $datosEmpresa && $datosContactoEmpresa) {
                                ?>

                            <div class="mb-3">
                                <label for="razonSocial" class="form-label">Razon Social</label>
                                <input class='form-control' type='text' name='razonSocial' id="razonSocial"
                                    value='<?php echo $datosEmpresa['RazonSocial']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="sitioWeb" class="form-label">Sitio Web</label>
                                <input class='form-control' type='text' name='sitioWeb' id="sitioWeb"
                                    value='<?php echo $datosEmpresa['SitioWeb']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="cuit" class="form-label">CUIT</label>
                                <input class='form-control' type='number' name='cuit' id="cuit"
                                    value='<?php echo $datosEmpresa['CUIT']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="ciudad" class="form-label">Ciudad</label>
                                <input class='form-control' type='text' name='ciudad' id="ciudad"
                                    value='<?php echo $datosContactoEmpresa['Ciudad']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input class='form-control' type='text' name='email' id="email"
                                    value='<?php echo $datosContactoEmpresa['Email']; ?>' />
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input class='form-control' type='number' name='telefono' id="telefono"
                                    value='<?php echo $datosContactoEmpresa['Telefono']; ?>' />
                            </div>

                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input class='form-control' type='password' name='password' id="password"
                                    placeholder='Contraseña' />
                            </div>

                            <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                                <!-- SE MODIFICO type='submit' a type='button' para que funcione el modal (ventana emergente) -->
                                <button class='button border-0' data-bs-toggle="modal" data-bs-target="#modal" type='button'>Modificar</button>
                            </div>

                            <!-- MODAL (Ventana Emergente) -->
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
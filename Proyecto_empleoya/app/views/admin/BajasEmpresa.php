<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php if (isset($_SESSION['tipo_usuario'])) {
    require_once "../Footer_Header/headerAdministrador.php";;

?>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='d-flex justify-content-center p-1'>
            <h1>Baja Empresa</h1>
        </div>

        <div class="container-fluid d-flex justify-content-center">
            <form class="d-flex" role="search" method="POST" action="../../controllers/AdminBuscarEmpresaControlador.php">
                <input class="form-control me-2" type="search" name="palabraClave" placeholder="Razón Social o CUIT" aria-label="Search" value="<?php echo isset($_POST['palabraClave']) ? $_POST['palabraClave'] : ''; ?>"/>
                <div class="btn-group mr-2" role="group">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                    <button class="btn btn-outline-success" type="submit">Listar</button>
                </div>
            </form>
        </div>

        <div class="p-5 pt-2">
            <div class="row">
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Opción</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>ID</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Razón Social</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>CUIT</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Sitio Web</h2>
                </div>
            </div>

            <?php
            require_once '../../../config/database.php';
            require_once '../../controllers/UsuarioControlador.php';

            $db = new Database();
            $usuarioModelo = new UsuarioModelo($db);
            $controller = new UsuarioControlador($usuarioModelo);
            $empresasVerificadas = $usuarioModelo->obtenerEmpresasVerificadas();
            ?>

            <div class="">
                <?php if (!isset($_SESSION['empresaEncontrada']))  : ?>
                    <?php foreach ($empresasVerificadas as $empresa) : ?>
                        <div class="row">
                            <div class="col d-flex justify-content-center border border-dark">
                                <!-- Botón "Dar de baja" con evento onClick -->
                                <button class="btn btn-danger p-1 m-1 btn-rechazar" data-toggle="modal" data-target="#confirmModal<?= $empresa['IDUsuario'] ?>" onclick="console.log('Botón Dar de baja clicado');">Dar de baja</button>

                            </div>
                            <div class="col d-flex align-items-center border border-dark"><?= $empresa['IDUsuario'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $empresa['RazonSocial'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $empresa['CUIT'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $empresa['SitioWeb'] ?></div>
                        </div>

                        <!-- Modal de confirmación para dar de baja -->
                        <div class="modal fade" id="confirmModal<?= $empresa['IDUsuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Confirmar Baja</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Al confirmar la baja de esta empresa, está ya no tendra acceso al portal.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <!-- Botón de confirmación -->
                                        <form method="POST" action="../../controllers/AdminControladorEmpresa.php">
                                            <!-- Campo de entrada oculto para enviar el ID -->
                                            <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                                            <button type="submit" class="btn btn-danger" name="accion" value="baja">Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php if (isset($_SESSION['empresaEncontrada'])) {
                        $empresaEncontrada = $_SESSION['empresaEncontrada'];
                        $encontrado  = true;
                        if (!empty($empresaEncontrada)) :
                            foreach ($empresaEncontrada as $empresa) : ?> 
                                <div class="row">
                                    <div class="col d-flex justify-content-center border border-dark">
                                        <!-- Botón "Dar de baja" con evento onClick -->
                                        <button class="btn btn-danger p-1 m-1 btn-rechazar" data-toggle="modal" data-target="#confirmModal<?= $empresa['IDUsuario'] ?>" onclick="console.log('Botón Dar de baja clicado');">Dar de baja</button>

                                    </div>

                                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['IDUsuario'] ?></div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['RazonSocial'] ?></div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['CUIT'] ?></div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['SitioWeb'] ?></div>
                                </div>

                                <!-- Modal de confirmación para dar de baja -->
                                <div class="modal fade" id="confirmModal<?= $empresa['IDUsuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmModalLabel">Confirmar Baja</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Al confirmar la baja de esta empresa, está ya no tendra acceso al portal.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <!-- Botón de confirmación -->
                                                <form method="POST" action="../../controllers/AdminControladorEmpresa.php">
                                                    <!-- Campo de entrada oculto para enviar el ID -->
                                                    <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                                                    <button type="submit" class="btn btn-danger" name="accion" value="baja">Confirmar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            <?php endforeach;
                        else : ?>
                            <p>No se encontraron detalles de empresas verificados.</p>
                    <?php endif;
                } ?>
                <?php endif; ?>
            
            <?php if (!isset($_SESSION['empresaEncontrada']) && empty($empresasVerificadas)) : ?>
                <p>No se encontraron detalles de empresa.</p>
            <?php endif; ?>
            </div>
        </div>
        <div class='p-1'>
                <a href="<?php echo $url; ?>public/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
        </div>


        <?php               
                                    if (isset($_SESSION['dadodebajaexitoso']) && $_SESSION['dadodebajaexitoso'] === true) {
                                                                
                                                                ?>
                                                                <!-- MODAL (Ventana Emergente) -->
                                                                <div class="modal fade" id="dadodebajaexitoso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header d-flex justify-content-center">
                                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">La empresa fue dada de baja con exito </h1>
                                                                                
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
                                                                        $('#dadodebajaexitoso').modal('show');
                                                                    });
                                
                                                                </script>
                                                                <?php
                                                                // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                                                                $_SESSION['dadodebajaexitoso'] = false;
                                                            }
                                    ?>
    </div>
</section>

    <!-- FOOTER -->
    <?php
        require_once "../Footer_Header/footer.php";
    ?>

</body>
</html>
<?php }?>
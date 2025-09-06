<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php if (isset($_SESSION['tipo_usuario'])) {
    require_once "../Footer_Header/headerAdministrador.php";;

?>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='d-flex justify-content-center p-1'>
            <h1>Baja Autoridad</h1>
        </div>

        <div class="container-fluid d-flex justify-content-center">
            <form class="d-flex" role="search" method="POST" action="../../controllers/AdminBuscarAutControlador.php">
                <input class="form-control me-2" type="search" name="palabraClave" placeholder="Nombre o Apellido" aria-label="Search" value="<?php echo isset($_POST['palabraClave']) ? $_POST['palabraClave'] : ''; ?>"/>
                <div class="btn-group mr-2" role="group">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                    <button class="btn btn-outline-success" type="submit">Listar</button>
                </div>
            </form>
        </div>

        <div class="p-5 pt-2">
            <div class="row">
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Opcion</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>ID</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Nombre</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Apellido</h2>
                </div>
            </div>
            <?php  
                // session_start();
                require_once '../../../config/database.php';
                require_once '../../controllers/UsuarioControlador.php';
                
                $db = new Database();
                $usuarioModelo = new UsuarioModelo($db);
                $controller = new UsuarioControlador($usuarioModelo);
                $AutVerificada = $usuarioModelo->obternerAutoridadVerificada();
            ?>

            <div class="">
            <?php if (!isset($_SESSION['autEncontrada']))  : ?>
                <?php foreach ($AutVerificada as $autoridad) : ?>
                    <div class="row">
                        <div class="col d-flex justify-content-center border border-dark">
                            <!-- Botón "Dar de baja" con evento onClick -->
                            <button class="btn btn-danger p-1 m-1 btn-rechazar" data-toggle="modal" data-target="#confirmModal<?= $autoridad['IDUsuario'] ?>">Dar de baja</button>
                        </div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['IDUsuario'] ?></div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Nombre'] ?></div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Apellido'] ?></div>
                    </div>

                    <!-- Modal de confirmación para "Dar de baja" -->
                    <div class="modal fade" id="confirmModal<?= $autoridad['IDUsuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar baja de autoridad</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Está seguro de que desea dar de baja a esta autoridad?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <!-- Botón de confirmación para dar de baja -->
                                    <form method="POST" action="../../controllers/AdminControladorAutoridad.php">
                                        <!-- Campo de entrada oculto para enviar el ID -->
                                        <input type="hidden" name="IDUsuario" value="<?= $autoridad['IDUsuario'] ?>">
                                        <button type="submit" class="btn btn-danger" name="accion" value="baja">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php else : ?>
                    <?php if (isset($_SESSION['autEncontrada'])) {
                        $autEncontrada = $_SESSION['autEncontrada'];
                        $encontrado  = true;
                        if (!empty($autEncontrada)) :
                            foreach ($autEncontrada as $autoridad) : ?> 
                                <div class="row">
                                    <div class="col d-flex justify-content-center border border-dark">
                                        <!-- Botón "Dar de baja" con evento onClick -->
                                        <button class="btn btn-danger p-1 m-1 btn-rechazar" data-toggle="modal" data-target="#confirmModal<?= $autoridad['IDUsuario'] ?>">Dar de baja</button>
                                    </div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $autoridad['IDUsuario'] ?></div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Nombre'] ?></div>
                                    <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Apellido'] ?></div>
                                </div>

                                <!-- Modal de confirmación para "Dar de baja" -->
                                <div class="modal fade" id="confirmModal<?= $autoridad['IDUsuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmar baja de autoridad</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de que desea dar de baja a esta autoridad?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <!-- Botón de confirmación para dar de baja -->
                                                <form method="POST" action="../../controllers/AdminControladorAutoridad.php">
                                                    <!-- Campo de entrada oculto para enviar el ID -->
                                                    <input type="hidden" name="IDUsuario" value="<?= $autoridad['IDUsuario'] ?>">
                                                    <button type="submit" class="btn btn-danger" name="accion" value="baja">Confirmar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                    else : ?>
                        <p>No se encontraron detalles de autoridades verificadas.</p>
                    <?php endif;
                } ?>
            <?php endif; ?>
            <?php if (!isset($_SESSION['autEncontrada']) && empty($AutVerificada)) : ?>
                <p>No se encontraron detalles de autoridad.</p>
            <?php endif; ?>
            </div>
        </div>

        <div class='p-1'>
            <a href="<?php echo $url; ?>/app/views/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
        </div>
    </div>
</section>

    <!-- FOOTER -->
    <?php
        require_once "../Footer_Header/footer.php";
    ?>

</body>
</html>
<?php }?>
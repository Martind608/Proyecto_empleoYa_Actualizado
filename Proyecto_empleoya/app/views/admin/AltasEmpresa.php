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
            <h1>Altas Empresas</h1>
        </div>

        <div class="container-fluid d-flex justify-content-center">
            <!-- Formulario de búsqueda (puedes descomentarlo si es necesario)
            <form class="d-flex" role="search" method="POST" action="../../controllers/AdminBuscarEmpresaControlador.php">
                <input class="form-control me-2" type="search" name="palabraClave" placeholder="Razón Social o CUIT" aria-label="Search" value="<?php echo isset($_POST['palabraClave']) ? $_POST['palabraClave'] : ''; ?>"/>
                <div class="btn-group mr-2" role="group">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                    <button class="btn btn-outline-success" type="submit">Listar</button>
                </div>
            </form>-->
        </div>

        <div class="p-5 pt-2">
            <div class="row">
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Opcion</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2 >ID</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Razón Social</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>CUIL</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Sitio Web</h2>
                </div>
            </div>

            <?php  
                // session_start();
                require_once '../../../config/database.php';
                require_once '../../controllers/UsuarioControlador.php';
                
                $db = new Database();
                $usuarioModelo = new UsuarioModelo($db);
                $controller = new UsuarioControlador($usuarioModelo);
                $empresasPendientes = $usuarioModelo->obtenerEmpresasPendientes();
            ?>

            <div class="">
                <?php if ($empresasPendientes) : ?>
                <?php foreach ($empresasPendientes as $empresa) : ?>
                <div class="row">
                    <div class="col d-flex justify-content-center border border-dark">
                        <!-- Botón "Alta" con modal de confirmación -->
                        <button class="btn btn-primary p-1 m-1 btn-aceptar" data-toggle="modal" data-target="#confirmModal<?= $empresa['IDUsuario'] ?>">Alta</button>

                        <!-- Botón "Rechazar" con modal de confirmación -->
                        <button class="btn btn-danger p-1 m-1 btn-rechazar" data-toggle="modal" data-target="#confirmModalRechazar<?= $empresa['IDUsuario'] ?>">Rechazar</button>
                    </div>

                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['IDUsuario'] ?></div>
                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['RazonSocial'] ?></div>
                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['CUIT'] ?></div>
                    <div class="col d-flex align-items-center border border-dark"><?= $empresa['SitioWeb'] ?></div>
                </div>
                <?php endforeach; ?>
                <?php else : ?>
                <p>No se encontraron detalles de empresas verificadas.</p>
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

<!-- Modales de confirmación para "Alta" y "Rechazo" -->
<?php if ($empresasPendientes) : ?>
<?php foreach ($empresasPendientes as $empresa) : ?>
    <!-- Modal de confirmación para "Alta" -->
    <div class="modal fade" id="confirmModal<?= $empresa['IDUsuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $empresa['IDUsuario'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?= $empresa['IDUsuario'] ?>">Confirmar Alta de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea dar de alta a esta empresa?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- Formulario de confirmación para dar de alta -->
                    <form method="POST" action="../../controllers/AdminControladorEmpresa.php">
                        <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                        <button type="submit" class="btn btn-primary" name="accion" value="alta">Confirmar Alta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación para "Rechazo" -->
    <div class="modal fade" id="confirmModalRechazar<?= $empresa['IDUsuario'] ?>" tabindex="-1" aria-labelledby="exampleModalLabelRechazar<?= $empresa['IDUsuario'] ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelRechazar<?= $empresa['IDUsuario'] ?>">Confirmar Rechazo de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea rechazar esta empresa?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!-- Formulario de confirmación para rechazar -->
                    <form method="POST" action="../../controllers/AdminControladorEmpresa.php">
                        <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                        <button type="submit" class="btn btn-danger" name="accion" value="rechazar">Confirmar Rechazo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>

<!-- FOOTER -->
<?php
    require_once "../Footer_Header/footer.php";
?>

</body>
</html>
<?php }?>
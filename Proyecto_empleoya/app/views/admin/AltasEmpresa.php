<?php
session_start();
$title = 'Altas Empresa';
require_once "../Footer_Header/headerAdministrador.php";
?>

<main>
    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center p-1'>
                <h1>Altas Empresas</h1>
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
                        <h2>CUIT</h2>
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
                            <!-- Botón "Alta" con evento onClick -->
                            <form method="POST" action="../../controllers/AdminControlador.php">
                                <!-- Campo de entrada oculto para enviar el ID -->
                                <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                                <button class="btn btn-primary p-1 m-1 btn-aceptar" type="submit" name="accion"
                                    value="alta">Alta</button>
                            </form>

                            <!-- Botón "Rechazar" con evento onClick -->
                            <form method="POST" action="../../controllers/AdminControlador.php">
                                <!-- Campo de entrada oculto para enviar el ID -->
                                <input type="hidden" name="IDUsuario" value="<?= $empresa['IDUsuario'] ?>">
                                <button class="btn btn-danger p-1 m-1 btn-rechazar" type="submit" name="accion"
                                    value="rechazar">Rechazar</button>
                            </form>
                        </div>

                        <div class="col d-flex align-items-center border border-dark"><?= $empresa['IDUsuario'] ?></div>
                        <div class="col d-flex align-items-center border border-dark"><?= $empresa['RazonSocial'] ?>
                        </div>
                        <div class="col d-flex align-items-center border border-dark"><?= $empresa['CUIT'] ?></div>
                        <div class="col d-flex align-items-center border border-dark"><?= $empresa['SitioWeb'] ?></div>
                    </div>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <p>No se encontraron detalles de empresas verificadas.</p>
                    <?php endif; ?>
                </div>




                <!-- MODAL ALTA (Ventana Emergente) -->
                <div class="modal fade" id="alta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pulse aceptar para confirmar el alta
                                </h1>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL RECHAZAR (Ventana Emergente) -->
                <div class="modal fade" id="rechazar" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Pulse aceptar rechazar</h1>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Rechazar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class='p-1'>
                    <a href="InicioAdmin.php">
                        <button type="button" class='button border-0 m-1'>
                            Volver
                        </button>
                    </a>
                </div>
            </div>
    </section>
</main>
<?php require_once '../Footer_Header/footer.php'; ?>
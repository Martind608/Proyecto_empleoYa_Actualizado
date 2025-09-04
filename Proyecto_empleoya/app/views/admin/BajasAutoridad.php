<?php
session_start();
$title = 'Bajas Autoridad';
require_once "../Footer_Header/headerAdministrador.php";
?>
<main>
    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center p-1'>
                <h1>Baja Autoridad</h1>
            </div>

            <div class="p-5 pt-2">
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
                    <?php if ($AutVerificada) : ?>
                    <?php foreach ($AutVerificada as $autoridad) : ?>
                    <div class="row">
                        <div class="col d-flex justify-content-center border border-dark">

                            <!-- Botón "Rechazar" con evento onClick -->
                            <form method="POST" action="../../controllers/AdminControladorAutoridad.php">
                                <!-- Campo de entrada oculto para enviar el ID -->
                                <input type="hidden" name="IDUsuario" value="<?= $autoridad['IDUsuario'] ?>">
                                <button class="btn btn-danger p-1 m-1 btn-rechazar" type="submit" name="accion"
                                    value="baja">Dar de baja</button>
                            </form>
                        </div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['IDUsuario'] ?>
                        </div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Nombre'] ?></div>
                        <div class="col d-flex align-items-center border border-dark"><?= $autoridad['Apellido'] ?>
                        </div>

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
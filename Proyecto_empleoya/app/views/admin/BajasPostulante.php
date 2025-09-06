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
            <h1>Baja Postulantes</h1>
        </div>

        <div class="container-fluid d-flex justify-content-center">
            <form class="d-flex" role="search" method="POST" action="../../controllers/AdminBuscarPostulanteControlador.php">
                <input class="form-control me-2" type="search" name="palabraClave" placeholder="Apellido o DNI" aria-label="Search" value="<?php echo isset($_POST['palabraClave']) ? $_POST['palabraClave'] : ''; ?>"/>
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
                    <h2>Nombre</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Apellido</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>DNI</h2>
                </div>
            </div>

            <?php
            require_once '../../../config/database.php';
            require_once '../../controllers/UsuarioControlador.php';

            $db = new Database();
            $usuarioModelo = new UsuarioModelo($db);
            $controller = new UsuarioControlador($usuarioModelo);
            $empresasVerificadas = $usuarioModelo->obtenerPostulantesAlta();
            ?>

            <div class="">
                <?php if (!isset($_SESSION['postulantesEncontrados']))  : ?>
                    <?php foreach ($empresasVerificadas as $postulante) : ?>
                        <div class="row">
                            <div class="col d-flex justify-content-center border border-dark">
                                <!-- Botón "Dar de baja" con evento onClick -->
                                <button class="btn btn-danger p-1 m-1" type="button" onclick="abrirModalBaja(<?= $postulante['IDUsuario'] ?>)">Dar de baja</button>
                            </div>
                            <div class="col d-flex align-items-center border border-dark"><?= $postulante['IDUsuario'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $postulante['Nombre'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $postulante['Apellido'] ?></div>
                            <div class="col d-flex align-items-center border border-dark"><?= $postulante['DNI'] ?></div>
                        </div>
                    
                    <?php endforeach; ?>
                <?php else : ?>
                        <?php if (isset($_SESSION['postulantesEncontrados'])) {
                            $postulantesEncontrados = $_SESSION['postulantesEncontrados'];
                            
                            if (!empty($postulantesEncontrados)) :
                                foreach ($postulantesEncontrados as $postulante) : ?> 
                                <div class="row">
                                        <div class="col d-flex justify-content-center border border-dark">
                                            <!-- Botón "Dar de baja" con evento onClick -->
                                            <button class="btn btn-danger p-1 m-1" type="button" onclick="abrirModalBaja(<?= $postulante['IDUsuario'] ?>)">Dar de baja</button>
                                        </div>
                                        
                                        <div class="col d-flex align-items-center border border-dark"><?= $postulante['IDUsuario'] ?></div>
                                        <div class="col d-flex align-items-center border border-dark"><?= $postulante['Nombre'] ?></div>
                                        <div class="col d-flex align-items-center border border-dark"><?= $postulante['Apellido'] ?></div>
                                        <div class="col d-flex align-items-center border border-dark"><?= $postulante['DNI'] ?></div>
                                    </div>
                                    <?php endforeach; ?>
                            <?php else:?>
                                <p>No se encontraron detalles de postulantes.</p>     
                            <?php endif; ?>
                        <?php } ?>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['postulantesEncontrados']) && !empty($postulantesEncontrados)) : ?>
                        <p>No se encontraron detalles de postulantes</p>
                    <?php endif; ?>
            </div>

        <!-- MODAL BAJA (Ventana Emergente) -->
        <div class="modal fade" id="bajaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <div class="modal-header d-flex justify-content-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmar baja de postulante</h1>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro de que desea dar de baja a este postulante?
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <!-- Botón de confirmación para dar de baja -->
                        <form method="POST" action="../../controllers/AdminControladorPostulante.php">
                            <!-- Campo de entrada oculto para enviar el ID -->
                            <input type="hidden" id="postulanteID" name="IDUsuario" value="">
                            <button type="submit" class="btn btn-danger" name="accion" value="dardebaja">Confirmar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='p-1'>
            <a href="<?php echo $url; ?>/app/views/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
        </div>
</section>

    <!-- FOOTER -->
    <?php
        require_once "../Footer_Header/footer.php";
    ?>  

<!-- Agrega este script en tu página para activar el modal de baja -->
<script>
    // Función para abrir el modal de baja con el ID del postulante
    function abrirModalBaja(postulanteID) {
        // Establecer el valor del campo de entrada oculto con el ID del postulante
        document.getElementById('postulanteID').value = postulanteID;
        // Mostrar el modal de baja
        $('#bajaModal').modal('show');
    }
</script>

</body>
</html>
<?php }?>
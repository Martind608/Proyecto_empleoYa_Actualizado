<?php
session_start();
$title = 'Bajas Postulante';
require_once "../Footer_Header/headerAdministrador.php";
?>
</main>
    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
          <div class='d-flex justify-content-center p-1'>
            <h1>Bajas Postulantes</h1>
          </div>

          <div class="p-5 pt-2">
            <?php  
            //   session_start();
              require_once '../../../config/database.php';
              require_once '../../controllers/UsuarioControlador.php';
              
              $db = new Database();
              $usuarioModelo = new UsuarioModelo($db);
              $controller = new UsuarioControlador($usuarioModelo);
              $postulantesPendientes = $usuarioModelo->obtenerPostulantesAlta();
          ?>
                   <div class="container">
    <?php if ($postulantesPendientes) : ?>
        <?php foreach ($postulantesPendientes as $postulante) : ?>
            <div class="row">
                <div class="col d-flex justify-content-center border border-dark">

                    <!-- Botón "Rechazar" con evento onClick -->
                    <form method="POST" action="../../controllers/AdminControladorPostulante.php">
                        <!-- Campo de entrada oculto para enviar el ID -->
                        <input type="hidden" name="IDUsuario" value="<?= $postulante['IDUsuario'] ?>">
                        <button class="btn btn-danger p-1 m-1" type="submit" name="accion" value="dardebaja">Dar de baja</button>
                    </form>
                </div>
                
                <div class="col d-flex align-items-center border border-dark"><?= $postulante['IDUsuario'] ?></div>
                <div class="col d-flex align-items-center border border-dark"><?= $postulante['Nombre'] ?></div>
                <div class="col d-flex align-items-center border border-dark"><?= $postulante['Apellido'] ?></div>
                <div class="col d-flex align-items-center border border-dark"><?= $postulante['DNI'] ?></div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No se encontraron detalles de empresas verificadas.</p>
    <?php endif; ?>
            </div>

          <!-- MODAL ALTA (Ventana Emergente) -->
          <div class="modal fade" id="baja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content ">
                      <div class="modal-header d-flex justify-content-center">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Pulse Baja para confirmar</h1>
                      </div>

                      <div class="modal-footer d-flex justify-content-center">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Baja</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class='p-1'>
            <a href="InicioAdmin.php">
              <button  type="button" class='button border-0 m-1'>
                Volver
              </button>
            </a>
          </div>
        </div>
    </section>
</main>
<?php require_once '../Footer_Header/footer.php'; ?>
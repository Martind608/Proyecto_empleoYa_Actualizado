<?php

$title = 'Inicio';

// Verifica si la sesión tiene una clave 'tipo_usuario'.
if (isset($_SESSION['tipo_usuario'])) {
    $tipo_usuario = $_SESSION['tipo_usuario'];
     if ($tipo_usuario == 'administrador') {
        require_once __DIR__ . '/Footer_Header/headerAdministrador.php';
    } elseif ($tipo_usuario == 'autoridad') {
        require_once __DIR__ . '/Footer_Header/headerAutoridad.php';
    } elseif ($tipo_usuario == 'empresa') {
        require_once __DIR__ . '/Footer_Header/headerEmpresa.php';
    } elseif ($tipo_usuario == 'postulante') {
        require_once __DIR__ . '/Footer_Header/headerPostulante.php';
    }
} else {
     require_once __DIR__ . '/Footer_Header/header.php';
}

?>
   
 <section class="home-wrapper-1 py-5">
    <div class='container-xxl'>
        <div class="d-flex justify-content-center">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="">
                        <?php if (!empty($ofertas)) : ?>
                            <?php foreach ($ofertas as $oferta) : ?>
                                <form method="POST" enctype="multipart/form-data" action="../app/controllers/Postularse_empleo.php">
                                        <div class="job-card shadow-sm p-3 mb-3">
                                        <h5><?php echo $oferta['Titulo']; ?></h5>
                                        <p class="mb-1"><?php echo $oferta['nombreEmpresa']; ?></p>
                                        <p class="text-muted mb-3"><?php echo $oferta['Modalidad']; ?> | <?php echo $oferta['Ubicacion']; ?> | <?php echo $oferta['Salario']; ?></p>
                                        <a href="#" class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#inicioSesion">Ver más</a>
                                        <input type="hidden" class="form-control" name="id_empresa" value="<?php echo $oferta['IDEmpresa']; ?>">
                                        <input type="hidden" name="IDEmpleo" value="<?php echo $oferta['IDEmpleo']; ?>">
                                        <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'postulante' && !$oferta['usuarioYaPostulado']) : ?>
                                            <input type="hidden" name="IDPostulante" value="<?php echo $idPostulante; ?>">
                                            <input type="hidden" name="accion" value="postularse">
                                            <input type="submit" value="Postularse" class="btn-secondary button border-0 btn-postularse">
                                        <?php endif; ?>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- MODAL (Ventana Emergente) -->
                    <div class="modal fade" id="inicioSesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADVERTENCIA!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Debe iniciar sesion para continuar
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a href="../app/views/login.php">
                                        <button class='btn btn-primary border-0' type='submit'>Iniciar Sesion</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                            
                    </div>

                        </div>

                    <!-- Modal Postulación Exitosa -->
                    <div class="modal fade" id="postulacionExitosa" tabindex="-1" aria-labelledby="postulacionExitosaLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="postulacionExitosaLabel">Éxito</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¡Te has postulado con éxito!
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
</section>
<?php if (isset($_GET['postulacion']) && $_GET['postulacion'] === 'exito'): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new bootstrap.Modal(document.getElementById('postulacionExitosa')).show();
    });
</script>
<?php endif; ?>
<?php require_once __DIR__ . '/Footer_Header/footer.php'; ?>

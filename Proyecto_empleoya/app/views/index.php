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
                                    <div class="col-md-11">
                                        <h4 class="justify-content-center"><?php echo $oferta['IDEmpleo']; ?></h4>
                                        <div class="card card-body border border-5 rounded">
                                            <h4 class="card-title"><?php echo $oferta['Titulo']; ?></h4>
                                            <p class="card-text">Fecha Publicacion: <?php echo $oferta['FechaPublicacion']; ?></p>
                                            <p class="card-text"> Empresa: <?php echo $oferta['nombreEmpresa']; ?></p>
                                            <p class="card-text"> Modalidad: <?php echo $oferta['Modalidad']; ?></p>
                                            <p class="card-text"> Ubicacion: <?php echo $oferta['Ubicacion']; ?></p>
                                            <p class="card-text"> TipoEmpleo: <?php echo $oferta['TipoEmpleo']; ?></p>
                                            <p class="card-text"> Descripcion <?php echo $oferta['Descripcion']; ?></p>
                                            <p class="card-text"> Salario <?php echo $oferta['Salario']; ?></p>
                                            <button class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#inicioSesion" type="button" style="display: inline-block; width: 150px;">Ver Más</button>
                                            <input type="hidden" class="form-control" name="id_empresa" value="<?php echo $oferta['IDEmpresa']; ?>">
                                            <input type="hidden" name="IDEmpleo" value="<?php echo $oferta['IDEmpleo']; ?>">
                                            <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'postulante' && !$oferta['usuarioYaPostulado']) : ?>
                                                <input type="hidden" name="IDPostulante" value="<?php echo $idPostulante; ?>">
                                                <input type="hidden" name="accion" value="postularse">
                                                <input type="submit" value="Postularse" class="btn-secondary button border-0" style="width: 155px;">
                                            <?php endif; ?>
                                        </div>
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
            </div>
        </div>
        </div>
</section>
<?php require_once __DIR__ . '/Footer_Header/footer.php'; ?>

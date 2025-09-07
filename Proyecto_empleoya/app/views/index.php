<?php
// Los datos ya vienen preparados desde el controlador
$headerPath = $this->determinarHeader($datosVista['tipoUsuario']);
require_once $headerPath;
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo $url; ?>/public/style/style.css">
    <title>Inicio Sesion</title>
</head>

<body>
<div class="wrapper">
    <div class="typing-demo">
        <p>OFERTAS PUBLICADAS</p>
    </div>
</div>

<button class="fa-solid fa-circle-arrow-up" onclick="topFunction()" id="myBtn" title="Go to top"></button>

<section class="home-wrapper-1 py-5">
    <div class='container-xxl'>
        <div class="justify-content-center">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="w-100">
                        <?php if (!empty($datosVista['ofertas'])): ?>
                            <?php foreach ($datosVista['ofertasReverso'] as $oferta): ?>
                                <form class="d-flex justify-content-center w-80" enctype="multipart/form-data">
                                    <div class="container cardsize p-1">
                                        <div class="card card-body border border-2 rounded w-100" data-aos="fade-right">
                                            <h1 class="card-title pb-3"><?= htmlspecialchars($oferta['Titulo']) ?></h1>
                                            <p class="fecha p-3"><strong><?= htmlspecialchars($oferta['FechaPublicacion']) ?></strong></p>
                                            <p class="card-text"><strong>Empresa: </strong><?= htmlspecialchars($oferta['nombreEmpresa']) ?></p>
                                            <p class="card-text"><strong>Tipo de Empleo: </strong><?= htmlspecialchars($oferta['TipoEmpleo']) ?></p>
                                            <p class="card-text"><strong>Modalidad: </strong><?= htmlspecialchars($oferta['Modalidad']) ?></p>
                                            <p class="card-text"><strong>Ubicacion: </strong><?= htmlspecialchars($oferta['Ubicacion']) ?></p>
                                            <p class="card-text"><strong>Salario: $</strong><?= htmlspecialchars($oferta['Salario']) ?></p>

                                            <?php if ($oferta['flyerExiste'] && $this->puedeDescargarFlyer($datosVista['tipoUsuario'])): ?>
                                                <div class="d-flex justify-content-center p-1">
                                                    <a class="btn btn-secondary button border-0" href="<?= htmlspecialchars($oferta['Flyer']) ?>" download>Flyer</a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($this->puedeVerMas($datosVista['tipoUsuario'])): ?>
                                                <div class="d-flex justify-content-center p-1">
                                                    <a href="<?php echo $url; ?>app/views/Postulante/DetalleOferta.php?IDEmpleo=<?= $oferta['IDEmpleo'] ?>">
                                                        <button class="btn-secondary button border-0" type="button" style="display: inline-block; width: 150px;">Ver Más</button>
                                                    </a>
                                                </div>
                                            <?php else: ?>
                                                <div class="d-flex justify-content-center p-1">
                                                    <button class="btn-secondary button border-0" data-bs-toggle="modal" data-bs-target="#inicioSesion" type="button" style="display: inline-block; width: 150px;">Ver Más</button>
                                                </div>
                                            <?php endif; ?>

                                            <input type="hidden" class="form-control" name="id_empresa" value="<?= $oferta['IDEmpresa'] ?>">
                                            <input type="hidden" name="IDEmpleo" value="<?= $oferta['IDEmpleo'] ?>">
                                            
                                            <?php if ($datosVista['idPostulante']): ?>
                                                <input type="hidden" name="IDPostulante" value="<?= $datosVista['idPostulante'] ?>">
                                            <?php endif; ?>

                                            <?php if ($this->puedePostularse($datosVista['tipoUsuario'], $oferta['usuarioYaPostulado'])): ?>
                                                <div class="d-flex justify-content-center p-1">
                                                    <button class="btn-secondary button border-0" style="width: 155px;" onclick="openModal(<?= $oferta['IDEmpleo'] ?>); return false;">Postularse</button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </form>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No hay ofertas disponibles en este momento.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Modal de Confirmación -->
                    <div class="modal fade" id="confirmacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pulse aceptar para confirmar la postulación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form id="postulacionForm" action="../controllers/Postularse_empleo.php" method="POST">
                                        <input type="hidden" name="accion" value="postularse">
                                        <input type="hidden" name="IDPostulante" value="<?= $datosVista['idPostulante'] ?>">
                                        <input type="hidden" name="IDEmpleo" value="">
                                        <button type="submit" class="btn btn-primary border-0">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function openModal(IDEmpleo) {
                            $('#confirmacion').modal('show');
                            document.getElementById('postulacionForm').elements['IDEmpleo'].value = IDEmpleo;
                        }
                    </script>

                    <!-- Modal Inicio Sesion -->
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
                                    <a href="../views/login.php">
                                        <button class='btn btn-primary border-0' type='submit'>Iniciar Sesion</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if ($datosVista['postulacionExitosa']): ?>
                        <!-- Modal Postulación Exitosa -->
                        <div class="modal fade" id="postulacionexitosa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header d-flex justify-content-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Postulacion realizada con exito !</h1>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary text-white" data-bs-dismiss="modal">Aceptar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#postulacionexitosa').modal('show');
                            });
                        </script>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once "Footer_Header/footer.php"; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
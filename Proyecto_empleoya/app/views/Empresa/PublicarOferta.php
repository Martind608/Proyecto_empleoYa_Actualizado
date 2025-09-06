<?php
session_start();
?>
<?php
require_once "../Footer_Header/headerEmpresa.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Página</title>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</head>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <h1 class='d-flex justify-content-center p-2'>Publicar Oferta Laboral</h1>

        <form action="../../controllers/CargarOfertaControlador.php" method="post">
            <div class='auth-card custom-width' action="../../controllers/CargarOfertaControlador.php" method="POST"
                enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="nombreOferta" class="form-label" style="font-weight: bold;">Nombre de la Oferta</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required />
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label" style="font-weight: bold;">Descripción de la Oferta</label>
                    <textarea type="text" class="form-control" id="descripcion" name="descripcion"  required>
                    </textarea>
                </div>

                <div class="mb-3">
                    <label for="ubicacion" class="form-label" style="font-weight: bold;">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required />
                </div>

                <div class="mb-3">
                    <label for="modalidad" class="form-label" style="font-weight: bold;">Modalidad</label>
                    <select class="form-select" id="modalidad" name="modalidad" required>
                        <option value="">Seleccione una modalidad</option>
                        <option value="Tiempo completo">Tiempo completo</option>
                        <option value="Medio tiempo">Medio tiempo</option>
                        <option value="Prácticas">Prácticas</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="requisitos" class="form-label" style="font-weight: bold;">Tipo de Empleo</label>
                    <input type="text" class="form-control" id="tipo_empleo" name="tipo_empleo" required />
                </div>

                <div class="mb-3">
                    <label for="salario" class="form-label" style="font-weight: bold;">Salario</label>
                    <input type="number" class="form-control" id="salario" name="salario" min="0" step="1"  />
                </div>

                <div class="mb-3">
                    <label for="fechaPublicacion" class="form-label" style="font-weight: bold;">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="fecha_public" name="fecha_public" required />
                </div>

                <div class="mb-3">
                    <label for="flyer" class="form-label" style="font-weight: bold;">Subir Flyer (PDF, imagen u otro formato permitido)</label>
                    <input type="file" class="form-control" id="flyer" name="flyer" accept=".pdf, .jpg, .jpeg, .png" />
                </div>

                <a href="<?php echo $url; ?>/app/views/index.php">
                    <button type="button" class='button border-0 m-1'>
                        Volver
                    </button>
                </a>


                <button type="submit" class='button border-0 m-1' data-bs-toggle="modal" data-bs-target="#modal">
                        Publicar Oferta
                    </button> 
                <!-- <button type="submit" class='button border-0 m-1'>
                    Publicar Oferta
                </button>-->

                <?php

                // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                if (isset($_SESSION['publicacionexitosa']) && $_SESSION['publicacionexitosa'] === true) {

                    ?>
                    <!-- MODAL (Ventana Emergente) --> 
                    <div class="modal fade" id="publicacionexitosa" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Oferta laboral publicada con éxito!</h1>
                                    <!-- Cambia el título aquí -->
                                </div>
                                <div class="modal-footer d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary text-white" data-bs-dismiss="modal">Aceptar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        // Utiliza JavaScript para mostrar el modal cuando la página se carga
                        $(document).ready(function () {
                            $('#publicacionexitosa').modal('show');
                        });

                    </script>
                    <?php
                    // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                    $_SESSION['publicacionexitosa'] = false;
                }
                ?>

            </div>
        </form>
    </div>

</section>

<!-- FOOTER -->
<?php
require_once "../Footer_Header/footer.php";
?>

</body>

</html>
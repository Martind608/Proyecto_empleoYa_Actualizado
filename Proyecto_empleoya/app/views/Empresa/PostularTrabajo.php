<?php
session_start();

$title = 'Publicar Oferta';
require_once "../Footer_Header/headerEmpresa.php";
?>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <h1 class='m-5 mt-0 mb-0 p-5  '>Publicar Oferta Laboral</h1>
            <form class='m-5 mt-0 mb-0 p-5 pt-0  ' action="../../controllers/CargarOfertaControlador.php" method="POST">

                <div class="mb-3">
                    <label for="nombreOferta" class="form-label">Nombre de la Oferta</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required />

                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción de la Oferta</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>


                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required />
                </div>

                <div class="mb-3">
                    <label for="modalidad" class="form-label">Modalidad</label>
                    <select class="form-select" id="modalidad" name="modalidad" required>
                        <option value="">Seleccione una modalidad</option>
                        <option value="Tiempo completo">Tiempo completo</option>
                        <option value="Medio tiempo">Medio tiempo</option>
                        <option value="Prácticas">Prácticas</option>
                    </select>
                </div>



                <div class="mb-3">
                    <label for="requisitos" class="form-label">Tipo de Empleo</label>
                    <input type="text" class="form-control" id="tipo_empleo" name="tipo_empleo" required />
                </div>


                <div class="mb-3">
                    <label for="salario" class="form-label">Salario</label>
                    <input type="number" class="form-control" id="salario" name="salario" min="0" step="1" />
                </div>



                <div class="mb-3">
                    <label for="fechaPublicacion" class="form-label">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="fecha_public" name="fecha_public" required />
                </div>

                <a href="../../../app/views/Empresa/InicioEmpresa.php">
                    <button type="button" class='button border-0 m-1'>
                        Volver
                    </button>
                </a>

                <button type="submit" class='button border-0 m-1' data-bs-toggle="modal" data-bs-target="#modal">
                    Publicar Oferta
                </button>

                <!-- MODAL (Ventana Emergente) -->
                <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                            <div class="modal-header d-flex justify-content-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Oferta Publicada Correctamente</h1>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>



<?php require_once '../Footer_Header/footer.php'; ?>
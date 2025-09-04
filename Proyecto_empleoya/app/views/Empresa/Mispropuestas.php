<?php
session_start();

$title = 'Mis Propuestas';
require_once "../Footer_Header/headerEmpresa.php";
?>
    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='m-5 p-5 pt-0 mt-2'>
                <h1>Mis Propuestas Laborales</h1>

                <?php
                    // session_start();
                    require_once '../../../config/database.php';
                    require_once '../../controllers/UsuarioControlador.php';

                    $db = new Database();
                    $usuarioModelo = new UsuarioModelo($db);
                    $controller = new UsuarioControlador($usuarioModelo);

                    $email = $_SESSION['Email'];
                    $datosIDEmpresa = $controller->obtenerIDUsuario($email);

                    // Llamar a la función para obtener las ofertas de la empresa
                    $ofertas = $controller->obtenerMisPropuestas($datosIDEmpresa);
                    
                    // $nombreEmpresa = $controller->obtenerNombreEmpresaPorID($datosIDEmpresa);
                    if ($ofertas) {
                        foreach ($ofertas as $oferta) {
                            // echo '<form method="POST" enctype="multipart/form-data" action="../controllers/Postularse_empleo.php">';
                            echo '<div class="row">';
                            echo '<!-- CARD OFERTA -->';
                            echo'<div class="card p-2 m-2">';
                            echo' <div class="card-body">';
                            echo'<h5 class="card-title">Nombre de la Oferta: '. $oferta['Titulo'] . '</h5>';
                            echo'<h6 class="card-subtitle mb-2 text-muted">Modalidad: '. $oferta['Modalidad'] . '</h6>';
                            echo'<p class="card-text">Descripción de la oferta de trabajo: '. $oferta['Descripcion'] . '</p>';
                            echo'<p class="card-text"><strong>Requisitos: '. $oferta['TipoEmpleo'] . '</strong></p>';
                            echo'<p class="card-text"><strong>Ubicación: '. $oferta['Ubicacion'] . '</strong></p>';
                            echo'<p class="card-text"><strong>Salario: '. $oferta['Salario'] . '</strong></p>';
                            echo'<p class="card-text"><strong>Fecha de Publicación: '. $oferta['FechaPublicacion'] . '</strong></p>';
                            echo '<a class="button border-0 m-1" href="#" data-bs-toggle="modal" data-bs-target="#modal'. $oferta['IDEmpleo'] . '">Ver más</a>';                      
                            // Agregar los botones dentro del mismo div del contenido de la oferta
                            echo '<button class="button border-0 m-1" href="#" data-bs-toggle="modal" data-bs-target="#modificar">Modificar</button>';
                            echo '<button class="button border-0 m-1" href="#" data-bs-toggle="modal" data-bs-target="#postulados">Postulados</button>';
                            echo '<button class="button border-0 m-1" href="#" data-bs-toggle="modal" data-bs-target="#cerrarPropuesta">Cerrar Propuesta</button>';

                            echo '</div>'; // Cierre del div con la clase "card-body"
                            echo '</div>'; // Cierre del div con la clase "card"

                            // Cierre del formulario
                            // echo '</form>';
                        }
                    } else {
                            echo '<p>No se encontraron ofertas laborales.</p>';
                            }
                        ?>
                    <?php if ($ofertas) { foreach ($ofertas as $oferta) : ?>
                        <div class="modal fade" id="modal<?= $oferta['IDEmpleo']; ?>" tabindex="-1" aria-labelledby="modalLabel<?= $oferta['IDEmpleo']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalLabel<?= $oferta['IDEmpleo']; ?>"><?= $oferta['Titulo']; ?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Descripción:</strong> <?= $oferta['Descripcion']; ?></p>
                                        <p><strong>Modalidad:</strong> <?= $oferta['Modalidad']; ?></p>
                                        <p><strong>Ubicación:</strong> <?= $oferta['Ubicacion']; ?></p>
                                        <p><strong>Salario:</strong> <?= $oferta['Salario']; ?></p>
                                        <p><strong>Fecha de Publicación:</strong> <?= $oferta['FechaPublicacion']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; } ?>
                <!-- MODAL MODIFICAR (ventana emergente) -->
                <div class="modal fade" id="modificar" tabIndex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-center">
                                <form class=''>
                                    <h2 class='p-1'>Modificar Oferta Laboral</h2>
                                    <div class="mb-3">
                                        <label for="nombreOferta" class="form-label">Nombre de la Oferta</label>
                                        <input type="text" class="form-control" id="nombreOferta" name="nombreOferta"
                                            required />
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
                                        <label for="descripcion" class="form-label">Descripción de la Oferta</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4"
                                            required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="requisitos" class="form-label">Requisitos</label>
                                        <textarea class="form-control" id="requisitos" name="requisitos" rows="4"
                                            required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ubicacion" class="form-label">Ubicación</label>
                                        <input type="text" class="form-control" id="ubicacion" name="ubicacion"
                                            required />
                                    </div>

                                    <div class="mb-3">
                                        <label for="fechaPublicacion" class="form-label">Fecha de Publicación</label>
                                        <input type="date" class="form-control" id="fechaPublicacion"
                                            name="fechaPublicacion" required />
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class='button border-0 m-1' data-bs-dismiss="modal">Guardar
                                    Cambios</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- MODAL POSTULADOS (ventana emergente) -->
                <div class="modal fade" id="postulados" tabIndex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-center">

                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Nombre: </h5>
                                        <h5 class="card-title">Apellido: </h5>
                                        <h6 class="card-subtitle mb-2 ">Correo Electrónico: postulante@example.com</h6>
                                        <p class="card-text">Teléfono: +123456789</p>
                                        <p class="card-text">Experiencia Laboral: Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit.</p>
                                        <p class="card-text">Educación: Título universitario en Ingeniería.</p>
                                        <p class="card-text">Habilidades: Habilidades técnicas, habilidades de
                                            comunicación.</p>
                                        <p class="card-text">Carta de Presentación: Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Fusce scelerisque ut tortor eget malesuada.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class='button border-0 m-1' data-bs-dismiss="modal">Aceptar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL CERRAR PROPUESTA (ventana emergente) -->
                <div class="modal fade" id="cerrarPropuesta" tabIndex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body d-flex justify-content-center">
                                <h2>Pulse aceptar para confirmar el cierre de la propuesta laboral</h2>
                            </div>

                            <div class="modal-footer d-flex justify-content-center">
                                <button type="button" class='btn btn-danger border-0 m-1'
                                    data-bs-dismiss="modal">Cancelar </button>
                                <button type="button" class='button  border-0 m-1' data-bs-dismiss="modal">Aceptar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

        <a href="../../../app/views/Empresa/InicioEmpresa.php">
            <button type="button" class='button border-0 m-1'>
                Volver
            </button>
        </a>
        </div>
        </div>
    </section>

<?php require_once '../Footer_Header/footer.php'; ?>
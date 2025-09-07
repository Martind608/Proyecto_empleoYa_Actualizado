<?php
session_start();
?>
<?php
// require_once "../Footer_Header/headerPostulante.php";
// Verifica si la sesión tiene una clave 'tipo_usuario'.
if (isset($_SESSION['tipo_usuario'])) {
    $tipo_usuario = $_SESSION['tipo_usuario'];
    if ($tipo_usuario == "administrador") {
        require_once "../Footer_Header/headerAdministrador.php"; // Ruta relativa al archivo header para administradores.
    } elseif ($tipo_usuario == "autoridad") {
        require_once "../Footer_Header/headerAutoridad.php"; // Ruta relativa al archivo header para autoridades.
    } elseif ($tipo_usuario == "empresa") {
        require_once "../Footer_Header/headerEmpresa.php"; // Ruta relativa al archivo header para empresas.
    } elseif ($tipo_usuario == "postulante") {
        require_once "../Footer_Header/headerPostulante.php"; // Ruta relativa al archivo header para postulantes.
    }
} else {
    // Si la sesión 'tipo_usuario' no existe, puedes incluir un encabezado por defecto o redirigir a la página de inicio de sesión.
    require_once '../Footer_Header/header.php';
}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<section class="home-wrapper-1 py-5">
    <div class='container-xxl'>
        <div class="d-flex justify-content-center">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">


                    <!-- Brand Items - Products -->

                    <div class="w-100">
                        <!-- Trabajos obtenidos desde el controlador -->
                        <?php
                        // Mostrar los datos actuales del usuario
                        
                        require_once '../../../config/database.php'; // Agrega esta línea para incluir la configuración
                        require_once '../../controllers/UsuarioControlador.php'; // Agrega esta línea para incluir el controlador
                        
                        $db = new Database();
                        $usuarioModelo = new UsuarioModelo($db);
                        $controller = new UsuarioControlador($usuarioModelo);

                        if (isset($_SESSION['Email'])) {
                            $emailPostulante = $_SESSION['Email']; // Obtener el email del postulante desde la sesión
                            $idPostulante = $controller->obtenerIDUsuario($emailPostulante); // Obtener el ID del postulante               
                        }


                        $IDEmpleo = $_GET['IDEmpleo'];
                        $oferta = $controller->obtenerOfertaEspecifica($usuarioModelo, $IDEmpleo);

                        if ($oferta) {
                            $idEmpresa = $oferta['IDEmpresa'];
                            $nombreEmpresa = $controller->obtenerNombreEmpresaPorID($idEmpresa);

                            echo '<form class="d-flex justify-content-center w-80"  enctype="multipart/form-data">';
                            echo '<div class="col-md-9">';

                            /* ID EMPLEO */
                            /* echo '<h4 class="justify-content-center">' . $oferta['IDEmpleo'] . '</h4>'; */
                            echo '<div class="card card-body border border-2 rounded w-100" data-aos="fade-right">';
                            echo '<h1 class="card-title pb-3 ">' . $oferta['Titulo'] . '</h1>';
                            echo '<p class="fecha p-3"><strong>' . $oferta['FechaPublicacion'] . '</strong></p>';
                            echo '<p class="card-text"><strong> Empresa: </strong>' . $nombreEmpresa . '</p>';
                            echo '<p class="card-text"><strong>Tipo de Empleo: </strong>' . $oferta['TipoEmpleo'] . '</p>';
                            echo '<p class="card-text"><strong>Modalidad: </strong>' . $oferta['Modalidad'] . '</p>';
                            echo '<p class="card-text"><strong> Ubicacion: </strong>' . $oferta['Ubicacion'] . '</p>';
                            echo '<p class="card-text"><strong>Descripcion: </strong>' . $oferta['Descripcion'] . '</p>';
                            echo '<p class="card-text"><strong> Salario: $</strong>' . $oferta['Salario'] . '</p>';

                            echo '<input type="hidden" class="form-control" name="id_empresa" value="' . $oferta['IDEmpresa'] . '">';
                            echo '<input type="hidden" name="IDEmpleo" value="' . $oferta['IDEmpleo'] . '">'; // Agrega el IDEmpleo
                        
                            if (!empty($oferta['Flyer'])) {
                                $rutaArchivo = '../' . $oferta['Flyer'];

                                // Comprueba si la ruta del archivo es válida
                                if (file_exists($rutaArchivo)) {
                                    if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'postulante') {
                                        // Muestra el botón de descarga
                                        echo '<div class="d-flex justify-content-center p-1">
                                            <a class="btn btn-secondary button border-0" href="' . $rutaArchivo . '" download>Flyer</a>
                                        </div>';
                                    }
                                }
                            }

                            if (isset($_SESSION['Email'])) {
                                echo '<input type="hidden" name="IDPostulante" value="' . $idPostulante . '">'; // Utiliza el ID del postulante obtenido
                            }


                            // Verifica si existe una sesión de usuario y si la clave "TipoUsuario" está definida
                            if (isset($_SESSION['tipo_usuario'])) {
                                if ($_SESSION['tipo_usuario'] == 'postulante') {
                                    // Verifica si el usuario ya está postulado para este trabajo (debes implementar esta lógica)
                                    $usuarioYaPostulado = $controller->usuarioYaPostulado($idPostulante, $oferta['IDEmpleo']);

                                    if (!$usuarioYaPostulado) {

                                        echo '<div class="d-flex justify-content-center p-1">';
                                        echo '<button class="btn-secondary button border-0" style="width: 155px;" onclick="openModal(' . $oferta['IDEmpleo'] . '); return false;">Postularse</button>';
                                        echo '</div>';

                                    }

                                }

                            }

                            echo '<!-- Agregar el botón Postularse aquí -->';
                            echo '</div>';
                            echo '</div>';
                            echo '</form>';
                        } else {
                            // Manejar el caso en el que no se encontró la oferta específica
                            echo "La oferta con IDEmpleo $IDEmpleo no se encontró.";
                        }
                        ?>

                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="confirmacion" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Pulse aceptar para confirmar
                                        la postulación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <form id="postulacionForm" action="../../controllers/Postularse_empleo.php"
                                        method="POST">
                                        <input type="hidden" name="accion" value="postularse">
                                        <input type="hidden" name="IDPostulante" value="<?php echo $idPostulante; ?>">
                                        <input type="hidden" name="IDEmpleo" value="">
                                        <button type="submit" class="btn btn-primary border-0">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        function openModal(IDEmpleo) {
                            // Abre el modal
                            $('#confirmacion').modal('show');
                            // Asigna el valor de IDEmpleo al campo oculto en el formulario del modal
                            document.getElementById('postulacionForm').elements['IDEmpleo'].value = IDEmpleo;
                        }

                    </script>



                    <!-- MODAL (Ventana Emergente) -->
                    <div class="modal fade" id="inicioSesion" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADVERTENCIA!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Debe iniciar sesion para continuar
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <a href="../views/login.php">
                                        <button class='btn btn-primary border-0' type='submit'>Iniciar Sesion</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class='p-1'>
            <a href="<?php echo $url; ?>/public/index.php">
                <button type="button" class='button border-0 m-1'>
                    Volver
                </button>
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<?php
require_once "../Footer_Header/footer.php";
?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script src="../../public/js/scripts.js"></script>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

</body>

</html>
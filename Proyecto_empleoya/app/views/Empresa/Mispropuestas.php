<?php
session_start();
?>
<?php
require_once "../Footer_Header/headerEmpresa.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class="justify-content-center">
            <div class="container-fluid">
                <div class="row justify-content-center">

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

                    if ($ofertas) {
                        foreach ($ofertas as $oferta) {
                            // echo '<form method="POST" enctype="multipart/form-data" action="../controllers/Postularse_empleo.php">';

                            echo '<form class="d-flex justify-content-center  w-80"  enctype="multipart/form-data" >';
                                echo '<div class="container cardsize p-1 ">';
                                    echo '<div class="card card-body border border-2 rounded w-100" data-aos="fade-right">';
                                        echo '<h1 class="card-title pb-3 ">' . $oferta['Titulo'] . '</h1>';
                                        echo '<p class="fecha p-3"><strong>' . $oferta['FechaPublicacion'] . '</strong></p>';
                                        echo '<p class="card-text"><strong>Tipo de Empleo: </strong>' . $oferta['TipoEmpleo'] . '</p>';
                                        echo '<p class="card-text"><strong>Modalidad: </strong>' . $oferta['Modalidad'] . '</p>';
                                        echo '<p class="card-text"><strong> Ubicacion: </strong>' . $oferta['Ubicacion'] . '</p>';
                                        echo '<p class="card-text"><strong>Descripcion: </strong>' . $oferta['Descripcion'] . '</p>';
                                        echo '<p class="card-text"><strong> Salario: $</strong>' . $oferta['Salario'] . '</p>';

                                        echo '<div class="d-flex justify-content-start p-1">';
                                            echo '<a class="button border-0 m-1" href="../../views/Empresa/MisPostulados.php? IDEmpleo=' . $oferta['IDEmpleo'] . '">Postulados</a>';
                                            echo '<a class="button border-0 m-1" href="javascript:void(0);" onclick="mostrarModalcerrar(' . $oferta['IDEmpleo'] . ')">Cerrar Propuesta</a>';
                                        echo '</div>';

                                    echo '</div>';
                                echo '</div>'; 
                            echo '</form>'; 

                        }
                    } else {
                        echo '<p>No se encontraron ofertas laborales.</p>';
                    }
                    ?>

                    <!-- Modal -->
                    <div class="modal fade" id="cerrarpropuesta" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">¿Está seguro de que desea cerrar
                                        esta propuesta de trabajo?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <form id="cerrarpropuestaForm" action="../../controllers/CerrarPropuesta.php"
                                        method="GET">
                                        <input type="hidden" name="accion" value="dardebajaempresa">
                                        <input type="hidden" name="IDEmpleo" value="">
                                        <button type="button" class="btn btn-primary border-0"
                                            onclick="enviarFormulariocerrar()">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        function mostrarModalcerrar(IDEmpleo) {
                            // Abre el modal
                            $('#cerrarpropuesta').modal('show');

                            // Establece el valor de IDEmpleo en el formulario de confirmación
                            document.getElementById('cerrarpropuestaForm').elements['IDEmpleo'].value = IDEmpleo;
                        }

                        function enviarFormulariocerrar() {
                            // Cierra el modal de confirmación
                            $('#cerrarpropuesta').modal('hide');

                            // Envía el formulario de confirmación al controlador
                            document.getElementById('cerrarpropuestaForm').submit();
                        }

                    </script>
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
    </div>
</section>

<!-- FOOTER -->
<?php
require_once "../Footer_Header/footer.php";
?>

</body>

</html>
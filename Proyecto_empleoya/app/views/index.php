<?php
// Inicia la sesión al principio del archivo
session_start();
?>
<?php
// Verifica si la sesión tiene una clave 'tipo_usuario'.
if (isset($_SESSION['tipo_usuario'])) {
    $tipo_usuario = $_SESSION['tipo_usuario'];
    if ($tipo_usuario == "administrador") {
        require_once "Footer_Header/headerAdministrador.php"; // Ruta relativa al archivo header para administradores.
    } elseif ($tipo_usuario == "autoridad") {
        require_once "Footer_Header/headerAutoridad.php"; // Ruta relativa al archivo header para autoridades.
    } elseif ($tipo_usuario == "empresa") {
        require_once "Footer_Header/headerEmpresa.php"; // Ruta relativa al archivo header para empresas.
    } elseif ($tipo_usuario == "postulante") {
        require_once "Footer_Header/headerPostulante.php"; // Ruta relativa al archivo header para postulantes.
    }
} else {
    // Si la sesión 'tipo_usuario' no existe, puedes incluir un encabezado por defecto o redirigir a la página de inicio de sesión.
    require_once 'Footer_Header/header.php';
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>



    <link rel="stylesheet" href="../../public/style/style.css">

    <title>Inicio Sesion</title>
</head>

<body>
<div class="wrapper">
        <div class="typing-demo">
            <p>
                OFERTAS PUBLICADAS
            </p>
        </div>
    </div>
    <button class="fa-solid fa-circle-arrow-up" onclick="topFunction()" id="myBtn" title="Go to top"></button>
    <section class="home-wrapper-1 py-5">
        <div class='container-xxl'>
            <div class="justify-content-center">
                <div class="container-fluid">
                    <div class="row justify-content-center">


                        <!-- Brand Items - Products -->

                        <div class="w-100">
                            <!-- Trabajos obtenidos desde el controlador -->
                            <?php
                            // Mostrar los datos actuales del usuario
                            
                            require_once '../../config/database.php'; // Agrega esta línea para incluir la configuración
                            require_once '../controllers/UsuarioControlador.php'; // Agrega esta línea para incluir el controlador
                            
                            $db = new Database();
                            $usuarioModelo = new UsuarioModelo($db);
                            $controller = new UsuarioControlador($usuarioModelo);

                            if (isset($_SESSION['Email'])) {
                                $emailPostulante = $_SESSION['Email']; // Obtener el email del postulante desde la sesión
                                $idPostulante = $controller->obtenerIDUsuario($emailPostulante); // Obtener el ID del postulante               
                            }


                            $ofertas = $controller->obtenerOfertas($usuarioModelo);
                            $ofertasReverso = array_reverse($ofertas);

                            if ($ofertas) {
                                foreach ($ofertasReverso as $oferta) {

                                    $idEmpresa = $oferta['IDEmpresa'];
                                    $nombreEmpresa = $controller->obtenerNombreEmpresaPorID($idEmpresa);

                                    echo '<form class="d-flex justify-content-center  w-80"  enctype="multipart/form-data" >'; //action="../controllers/Postularse_empleo.php"
                                    echo '<div class="container cardsize p-1 ">';
                                    echo '<div class="card card-body border border-2 rounded w-100" data-aos="fade-right">';
                                    echo '<h1 class="card-title pb-3 ">' . $oferta['Titulo'] . '</h1>';
                                    echo '<p class="fecha p-3"><strong>' . $oferta['FechaPublicacion'] . '</strong></p>';
                                    echo '<p class="card-text"><strong> Empresa: </strong>' . $nombreEmpresa . '</p>';
                                    echo '<p class="card-text"><strong>Tipo de Empleo: </strong>' . $oferta['TipoEmpleo'] . '</p>';
                                    echo '<p class="card-text"><strong>Modalidad: </strong>' . $oferta['Modalidad'] . '</p>';
                                    echo '<p class="card-text"><strong> Ubicacion: </strong>' . $oferta['Ubicacion'] . '</p>';
                                    echo '<p class="card-text"><strong> Salario: $</strong>' . $oferta['Salario'] . '</p>';

                                    $rutaArchivo = $oferta['Flyer'];

                                    // Comprueba si la ruta del archivo es válida
                                    if (file_exists($rutaArchivo)) {

                                        if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'postulante') {
                                            // Muestra el botón de descarga
                                            echo '<div class="d-flex justify-content-center p-1">
                                <a class="btn btn-secondary button border-0" href="' . $rutaArchivo . '" download>Flyer</a>
                            </div>';
                                        }
                                    }


                                    // Verifica si existe la sesión y si es de tipo postulante
                                    if (isset($_SESSION['tipo_usuario']) && ($_SESSION['tipo_usuario'] == 'postulante' || $_SESSION['tipo_usuario'] == 'empresa' || $_SESSION['tipo_usuario'] == 'administrador' || $_SESSION['tipo_usuario'] == 'autoridad')) {
                                        // Redirige a la página de Empresa/DetalleOferta.php si es un postulante
                                        echo '<div class="d-flex justify-content-center p-1">
                                                    <a href="Postulante/DetalleOferta.php?IDEmpleo=' . $oferta['IDEmpleo'] . '"><button class="btn-secondary button border-0" type="button" style="display: inline-block; width: 150px;">Ver Más</button></a>
                                                </div>';
                                    } else {
                                        // Muestra el botón dentro del modal si no es un postulante
                                        echo '<div class="d-flex justify-content-center p-1">
                                                    <button class="btn-secondary button border-0" data-bs-toggle="modal" data-bs-target="#inicioSesion" type="button" style="display: inline-block; width: 150px;">Ver Más</button>
                                                </div>';
                                    }

                                    echo '<input type="hidden" class="form-control" name="id_empresa" value="' . $oferta['IDEmpresa'] . '">';


                                    echo '<input type="hidden" name="IDEmpleo" value="' . $oferta['IDEmpleo'] . '">'; // Agrega el IDEmpleo
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


                                    echo '</div>';
                                    echo '</div>';

                                    echo '</form>';
                                }
                            }else {
                            // Aca dejo para ver si quiere poner ofertas vacias cuando no hayan ofertas, asi no queda vacia pagina
                                echo "No hay ofertas disponibles en este momento."; 
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
                                        <form id="postulacionForm" action="../controllers/Postularse_empleo.php"
                                            method="POST">
                                            <input type="hidden" name="accion" value="postularse">
                                            <input type="hidden" name="IDPostulante"
                                                value="<?php echo $idPostulante; ?>">
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

                        <!-- MODAL Inicio Sesion (Ventana Emergente) -->
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
                                            <button class='btn btn-primary border-0' type='submit'>Iniciar
                                                Sesion</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
            // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
            if (isset($_SESSION['postulacionexitosa']) && $_SESSION['postulacionexitosa'] === true) {

                ?>
                <!-- MODAL (Ventana Emergente) -->
                <div class="modal fade" id="postulacionexitosa" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header d-flex justify-content-center">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Postulacion realizada con
                                            exito !</h1>
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
                        $('#postulacionexitosa').modal('show');
                    });

                </script>
                <?php
                // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                $_SESSION['postulacionexitosa'] = false;
            }
            ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    require_once "Footer_Header/footer.php";
    ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="../../public/js/scripts.js"></script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
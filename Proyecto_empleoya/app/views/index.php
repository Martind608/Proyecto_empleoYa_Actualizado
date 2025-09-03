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
    <section class="home-wrapper-1 py-5">
        <div class='container-xxl'>
            <div class="d-flex justify-content-center">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center">
                        <!-- Brand List -->
                        <!-- <div class="col-md-3">
                            <form action="" method="GET">
                                <div class="card shadow mt-3">
                                    <div class="card-header">
                                        <h5>Filtros
                                            <button type="submit" class="btn btn-primary btn-sm float-end">Buscar</button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <h6>AREAS</h6> -->
                        <!-- <hr> -->
                        <!-- Áreas obtenidas desde el controlador -->
                        <!-- PHP loop removed for HTML cleanliness -->
                        <!-- Checkbox input and labels -->
                        <!-- </div>
                                </div>
                            </form>
                        </div> -->

                        <!-- Brand Items - Products -->
                        
                        <div class="">
                            <!-- Trabajos obtenidos desde el controlador -->
                            <?php
                            // Mostrar los datos actuales del usuario
                            /* session_start(); */
                            require_once '../../config/database.php'; // Agrega esta línea para incluir la configuración
                            require_once '../controllers/UsuarioControlador.php'; // Agrega esta línea para incluir el controlador

                            $db = new Database();
                            $usuarioModelo = new UsuarioModelo($db);
                            $controller = new UsuarioControlador($usuarioModelo);

                            if (isset($_SESSION['Email'])) {
                                $emailPostulante = $_SESSION['Email']; // Obtener el email del postulante desde la sesión
                                $idPostulante = $controller->obtenerIDUsuario($emailPostulante); // Obtener el ID del postulante               
                            }  
                            // $emailPostulante = $_SESSION['Email']; // Obtener el email del postulante desde la sesión
                            // $idPostulante = $controller->obtenerIDUsuario($emailPostulante); // Obtener el ID del postulante

                            $ofertas = $controller->obtenerOfertas($usuarioModelo);

                            if ($ofertas) {
                                foreach ($ofertas as $oferta) {

                                $idEmpresa = $oferta['IDEmpresa'];
                                $nombreEmpresa = $controller->obtenerNombreEmpresaPorID($idEmpresa);
                        
                                echo '<form method="POST" enctype="multipart/form-data" action="../controllers/Postularse_empleo.php">';
                                echo '<div class="col-md-11">';
                               
                                echo '<h4 class="justify-content-center">' . $oferta['IDEmpleo'] . '</h4>';
                                echo '<div class="card card-body border border-5 rounded">';
                                echo '<h4 class="card-title">' . $oferta['Titulo'] . '</h4>';
                                echo '<p class="card-text">Fecha Publicacion: ' . $oferta['FechaPublicacion'] . '</p>';
                                echo '<p class="card-text"> Empresa: ' . $nombreEmpresa . '</p>'; // Usamos el nombre obtenido
                                echo '<p class="card-text"> Modalidad: ' . $oferta['Modalidad'] . '</p>';
                                echo '<p class="card-text"> Ubicacion: ' . $oferta['Ubicacion'] . '</p>';
                                echo '<p class="card-text"> TipoEmpleo: ' . $oferta['TipoEmpleo'] . '</p>';
                                echo '<p class="card-text"> Descripcion ' . $oferta['Descripcion'] . '</p>';
                                echo '<p class="card-text"> Salario ' . $oferta['Salario'] . '</p>';
                                echo '<button class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#inicioSesion" type="button" style="display: inline-block; width: 150px;">Ver Más</button>';

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

                                        if (!$usuarioYaPostulado){
                                            
                                            echo '<input type="hidden" name="accion" value="postularse">';
                                            echo '<input type="submit" value="Postularse" class="btn-secondary button border-0" style="width: 155px;" >';
                                        }
                                    }
                                }

                                echo '<!-- Agregar el botón Postularse aquí -->';
                                echo '</div>';
                                echo '</div>';
                                
                                echo '</form>';
                            }
                        }
                        ?>
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
        </div>
    </section>

    <footer class='py-4 footer'>
        <div class='row'>
            <div class='col-12'>
                <p class='text-center mb-0 text-white'>&copy; 2023: Desarrollado por Juan23</p>
            </div>
        </div>
    </footer>

</body>

</html>
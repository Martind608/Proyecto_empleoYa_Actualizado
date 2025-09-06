<body>
    <?php
    session_start();
    // Verificar si se recibió el parámetro IDUsuario en la URL
    if (isset($_GET['IDUsuario'])) {
        $IDUsuario = $_GET['IDUsuario'];


    } else {

        echo 'No se proporcionó un IDUsuario válido en la URL.';
        exit; // Terminar la ejecución del script
    }
    ?>

    <?php
    require_once "../Footer_Header/headerEmpresa.php";
    ?>

    <?php
    require_once '../../../config/database.php';
    require_once '../../controllers/UsuarioControlador.php';

    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);
    $perfilPostulados = $controller->obtenerDatosPostulante($IDUsuario);
    $idContactoPostulante = $perfilPostulados['IDContacto'];
    $datosContactoPostulante = $controller->obtenerDatosContacto($idContactoPostulante);

    ?>
    <div class="d-flex justify-content-center p-5">
        <div class="container-sm">
            <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                    <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                </div>

                <div class="container-sm">

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">Nombre</h5>
                        <input class='form-control p-1' type='text' name='Nombre'
                            value='<?php echo $perfilPostulados['Nombre']; ?>' disabled />
                    </div>

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">Apellido</h4>
                            <input class='form-control p-2' type='text' name='Apellido'
                                value='<?php echo $perfilPostulados['Apellido']; ?>' disabled />
                    </div>

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">DNI</h6>
                            <input class='form-control p-1' type='text' name='DNI'
                                value='<?php echo $perfilPostulados['DNI']; ?>' disabled />
                    </div>

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">Email</h6>
                            <input class='form-control p-1' type='text' name='Email'
                                value='<?php echo $datosContactoPostulante['Email']; ?>' disabled />
                    </div>

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">Telefono</h6>
                            <input class='form-control p-1' type='text' name='Telefono'
                                value='<?php echo $datosContactoPostulante['Telefono']; ?>' disabled />
                    </div>

                    <div class="p-2 m-2">
                        <h5 class="card-title p-1">Ciudad</h6>
                            <input class='form-control p-1' type='text' name='Ciudad'
                                value='<?php echo $datosContactoPostulante['Ciudad']; ?>' disabled />
                    </div>

                </div>

                <?php 
                    // Verifica si el campo 'CV' en la base de datos está vacío
                    if (!empty($perfilPostulados['CV'])) {
                        // Ruta del archivo del CV
                        $rutaArchivo = "../" . $perfilPostulados['CV'];

                        // Comprueba si el archivo del CV existe
                        if (file_exists($rutaArchivo)) {
                            // Muestra el botón de descarga
                            echo '<div class="d-flex justify-content-center p-2 m-2">
                                    <a class="btn btn-secondary button border-0" href="' . $rutaArchivo . '" download>Descargar CV</a>
                                </div>';
                        } else {
                            // Muestra un mensaje de error
                            echo '<div class="d-flex justify-content-center p-2 m-2">
                                    <p>Este postulante no ha cargado un CV o el CV no está disponible en este momento.</p>
                                </div>';
                        }
                    } else {
                        // Muestra un mensaje de error indicando que el postulante no ha cargado un CV
                        echo '<div class="d-flex justify-content-center p-2 m-2">
                                <p>Este postulante no ha cargado un CV.</p>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class='p-1'>
        <a href="Mispropuestas.php">
            <button type="button" class='button border-0 m-1'>
                Volver
            </button>
        </a>
    </div>

    </div>
    </section>

    </div>

    <!-- FOOTER -->
    <?php
    require_once "../Footer_Header/footer.php";
    ?>

</body>
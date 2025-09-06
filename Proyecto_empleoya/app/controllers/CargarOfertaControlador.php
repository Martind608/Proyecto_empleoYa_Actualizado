<?php
require_once '../../config/database.php'; // Asegúrate de tener el archivo de configuración de la base de datos
require_once '../models/UsuarioModelo.php'; // Asegúrate de tener el modelo de usuario importado
require_once '../../config/app.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    session_start();
    
     // Obtener los datos del formulario
     $email = $_SESSION['Email'];
     $titulo = $_POST['titulo'];
     $descripcion = $_POST['descripcion'];
     $ubicacion = $_POST['ubicacion'];
     $modalidad = $_POST['modalidad'];
     $tipo_empleo = $_POST['tipo_empleo'];
     $salario = isset($_POST['salario']) ? $_POST['salario'] : 0;
     $fecha_public = $_POST['fecha_public'];


    // Verificar si se subió un archivo
    // Verificar si se subió un archivo Flyer
if (isset($_FILES["flyer"]) && $_FILES["flyer"]["error"] === UPLOAD_ERR_OK) {
    $carpetaDestino = "../../public/img/flyerempresa/";
    $nombreArchivoOriginal = $_FILES["flyer"]["name"];
    
    // Generar un nombre único para el archivo Flyer
    $nombreArchivoUnico = uniqid() . "_" . $nombreArchivoOriginal;
    $rutaCompleta = $carpetaDestino . $nombreArchivoUnico;

    // Mover el archivo Flyer al destino deseado
    if (move_uploaded_file($_FILES["flyer"]["tmp_name"], $rutaCompleta)) {
        // Llama a la función para guardar la oferta de trabajo con la ruta del flyer único
        if ($usuarioModelo->cargarTrabajoEmpresa($email, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public, $rutaCompleta)) {
            session_start();
    
            $_SESSION['publicacionexitosa'] = true;
            // Registro exitoso, redirige a una página de inicio de sesión o muestra un mensaje de éxito.
            header('Location: ' . SERVERURL . 'app/views/Empresa/PublicarOferta.php');
           
        } else {
            // Error en el registro, muestra un mensaje de error.
            echo "Error al publicar la oferta de trabajo";
        }
    } else {
        echo "Hubo un error al subir el archivo Flyer.";
    }
} else {
    if ($usuarioModelo->cargarTrabajoEmpresa($email, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public, null)) {
        session_start();
    
        $_SESSION['publicacionexitosa'] = true;
        header('Location: ' . SERVERURL . 'app/views/Empresa/PublicarOferta.php');

}

}
}

?>

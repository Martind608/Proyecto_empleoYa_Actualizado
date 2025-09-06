<?php
require_once '../../config/app.php';

require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';

// Verificar si el usuario ha iniciado sesión (puedes agregar más lógica aquí)
session_start();
if (!isset($_SESSION['Email'])) {
    header('Location: ' . SERVERURL . 'app/views/inicio_de_sesion.php'); // Redirige al inicio de sesión si no está autenticado
    exit();
}

// Inicializa la instancia del controlador y el modelo
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);
$controller = new UsuarioControlador($usuarioModelo);

// Obtener datos del formulario
$email = $_SESSION['Email'];
$nombre = $_POST["Nombre"];
$apellido = $_POST["Apellido"];
$telefono = $_POST["Telefono"];
$dni = $_POST["DNI"];
$ciudad = $_POST["Ciudad"];
$emailContacto = $_POST["Email"];
$nuevaPassword = $_POST["password"];


// Verificar si el nuevo correo electrónico es diferente del correo electrónico actual
if ($emailContacto !== $email) {
    // El nuevo correo electrónico es diferente, verificamos si existe
    if ($controller->existeCorreoElectronico($emailContacto)) {
        header('Location: ' . SERVERURL . 'app/views/Postulante/EditarPostulante.php');
        $_SESSION['Registroincorrecto'] = true;
        exit();
    }
}




$ID=$usuarioModelo->obtenerIDUsuario($email);
$nombreCVActual = $usuarioModelo->obtenerNombreCVActual($ID);
// Verificar si se subió un archivo CV
if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === UPLOAD_ERR_OK) {
            // Verificar que el tamaño del archivo sea menor a 5MB
            if ($_FILES["cv"]["size"] > 5242880) {
                $_SESSION["errorcv"] = true;
                header('Location: ' . SERVERURL . 'app/views/Postulante/EditarPostulante.php');
                exit();
            }
    $carpetaDestino = "../../public/img/CV-Postulantes/";
    $nombreArchivoOriginal = $_FILES["cv"]["name"];
    
    // Generar un nombre único para el archivo CV
    $nombreArchivoUnico = uniqid() . "_" . $nombreArchivoOriginal;
    $rutaCompleta = $carpetaDestino . $nombreArchivoUnico;

      // Eliminar el CV anterior si existe
      if ($nombreCVActual !== null) {
        $rutaCVAntiguo = $carpetaDestino . $nombreCVActual;
        if (file_exists($rutaCVAntiguo)) {
            unlink($rutaCVAntiguo);
        }
    }


    // Mover el archivo CV al destino deseado
    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $rutaCompleta)) {
        // Llama a la función para guardar los datos del postulante con el nombre del CV único
        if ($usuarioModelo->actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $rutaCompleta, $nuevaPassword)) {
            header('Location: ' . SERVERURL . 'app/views/Postulante/EditarPostulante.php');
            $_SESSION['Email'] = $emailContacto;
            $_SESSION['exito_actualizacion'] = true;
            exit();
        } else {
            // Error en el registro, muestra un mensaje de error.
            echo "Error al actualizar los datos";
        }
    } else {
        echo "Hubo un error al subir el archivo CV.";
    }
} else {
            // $nombreCVActual = $usuarioModelo->obtenerNombreCVActual($ID);
    if ($usuarioModelo->actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $nombreCVActual, $nuevaPassword)) {
        header('Location: ' . SERVERURL . 'app/views/Postulante/EditarPostulante.php');
        $_SESSION['Email'] = $emailContacto;
        $_SESSION['exito_actualizacion'] = true;
        exit();
    } else {
        // Error en el registro, muestra un mensaje de error.
        echo "Error al actualizar los datos";
    }
}

?>
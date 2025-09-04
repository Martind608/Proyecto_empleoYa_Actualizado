<?php

require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';
require_once '../../config/csrf.php';
// Verificar si el usuario ha iniciado sesión (puedes agregar más lógica aquí)
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: inicio_de_sesion.php"); // Redirige al inicio de sesión si no está autenticado
    exit();
}
verify_csrf_token();
// Inicializa la instancia del controlador y el modelo
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);
$controller = new UsuarioControlador($usuarioModelo);

// Obtener datos del formulario de manera segura
$email = $_SESSION['Email'];
$errors = [];

$nombre = filter_input(INPUT_POST, "Nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$nombre) { $errors[] = "Nombre inválido."; }

$apellido = filter_input(INPUT_POST, "Apellido", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$apellido) { $errors[] = "Apellido inválido."; }

$telefono = filter_input(INPUT_POST, "Telefono", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$telefono) { $errors[] = "Teléfono inválido."; }

$dni = filter_input(INPUT_POST, "DNI", FILTER_SANITIZE_NUMBER_INT);
if (!$dni) { $errors[] = "DNI inválido."; }

$ciudad = filter_input(INPUT_POST, "Ciudad", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$ciudad) { $errors[] = "Ciudad inválida."; }

$emailContacto = filter_input(INPUT_POST, "Email", FILTER_VALIDATE_EMAIL);
if (!$emailContacto) { $errors[] = "Email de contacto inválido."; }

// Manejo del archivo CV
$cv = null;
if (isset($_FILES["cv"]["tmp_name"])) {
    $cv = file_get_contents($_FILES["cv"]["tmp_name"]);
} else {
    $errors[] = "CV inválido.";
}

$nuevaPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$nuevaPassword) { $errors[] = "Contraseña inválida."; }

if ($errors) {
    echo implode('<br>', $errors);
    exit;
}


if ($controller->actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $cv, $nuevaPassword)) {
    $_SESSION['exito_actualizacion'] = true;
    header("Location: ../views/Postulante/EditarPostulante.php");
    $_SESSION['Email'] = $emailContacto;
    exit();
} else {
    // Manejar errores si la actualización falla
    echo "Error al actualizar los datos.";
}



?>
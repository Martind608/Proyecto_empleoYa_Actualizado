<?php


require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';
require_once '../../config/csrf.php';
// Verificar si el usuario ha iniciado sesión 
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

$razonSocial = filter_input(INPUT_POST, "razonSocial", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$razonSocial) { $errors[] = "Razón social inválida."; }

$sitioWeb = filter_input(INPUT_POST, "sitioWeb", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$sitioWeb) { $errors[] = "Sitio web inválido."; }

$cuit = filter_input(INPUT_POST, "cuit", FILTER_SANITIZE_NUMBER_INT);
if (!$cuit) { $errors[] = "CUIT inválido."; }

$ciudad = filter_input(INPUT_POST, "ciudad", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$ciudad) { $errors[] = "Ciudad inválida."; }

$emailContacto = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
if (!$emailContacto) { $errors[] = "Email de contacto inválido."; }

$telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$telefono) { $errors[] = "Teléfono inválido."; }

$nuevaPassword = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if (!$nuevaPassword) { $errors[] = "Contraseña inválida."; }

if ($errors) {
    echo implode('<br>', $errors);
    exit;
}


if ($controller->actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword)) {
  
    header("Location: ../views/Empresa/EditarEmpresa.php");
    $_SESSION['Email'] = $emailContacto;
    exit();
} else {
    // Manejar errores si la actualización falla
    echo "Error al actualizar los datos.";
}




?>

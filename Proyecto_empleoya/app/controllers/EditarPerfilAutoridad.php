<?php


require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';

// Verificar si el usuario ha iniciado sesión 
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: inicio_de_sesion.php"); // Redirige al inicio de sesión si no está autenticado
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
$ciudad = $_POST["ciudad"];
$emailContacto = $_POST["email"];
$telefono = $_POST["telefono"];
$nuevaPassword = $_POST["password"];


if ($controller->actualizarDatosAutoridadContacto($email, $nombre, $apellido, $emailContacto, $telefono, $ciudad, $nuevaPassword)) {
  
    header("Location: ../views/Autoridad/EditarAutoridad.php");
    $_SESSION['Email'] = $emailContacto;
    $_SESSION['exito_actualizacion'] = true;
   
    exit();
} else {
    // Manejar errores si la actualización falla
    session_start();
        $_SESSION['error_registro_autoridad'] = "El correo electrónico ya existe.";
        header("Location: ../views/Autoridad/EditarAutoridad.php");
}




?>

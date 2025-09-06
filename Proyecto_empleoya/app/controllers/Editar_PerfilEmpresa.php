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
$razonSocial = $_POST["razonSocial"];
$sitioWeb = $_POST["sitioWeb"];
$cuit = $_POST["cuit"];
$ciudad = $_POST["ciudad"];
$emailContacto = $_POST["email"];
$telefono = $_POST["telefono"];
$nuevaPassword = $_POST["password"];



// Verificar si el nuevo correo electrónico es diferente del correo electrónico actual
if ($emailContacto !== $email) {
    // El nuevo correo electrónico es diferente, verificamos si existe
    if ($controller->existeCorreoElectronico($emailContacto)) {
        header("Location: ../views/Empresa/EditarEmpresa.php");
        $_SESSION['Registroincorrecto'] = true;
        exit();
    }
}

if ($controller->actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword)) {
  
    header("Location: ../views/Empresa/EditarEmpresa.php");
    $_SESSION['Email'] = $emailContacto;
    $_SESSION['exito_actualizacion'] = true;
    exit();
} else {
    // Manejar errores si la actualización falla
    echo "Error al actualizar los datos.";
}




?>

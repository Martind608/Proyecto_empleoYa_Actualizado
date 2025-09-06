<?php

require_once '../../config/app.php';
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';

// Verificar si el usuario ha iniciado sesión 
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
$razonSocial = $_POST["razonSocial"];
$sitioWeb = $_POST["sitioWeb"];
$cuit = $_POST["cuit"];
$ciudad = $_POST["ciudad"];
$emailContacto = $_POST["email"];
$telefono = $_POST["telefono"];
$nuevaPassword = $_POST["password"];


if ($controller->actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword)) {
  
    header('Location: ' . SERVERURL . 'app/views/datosactualizados.php');
    $_SESSION['Email'] = $emailContacto;
    exit();
} else {
    // Manejar errores si la actualización falla
    echo "Error al actualizar los datos.";
}




?>

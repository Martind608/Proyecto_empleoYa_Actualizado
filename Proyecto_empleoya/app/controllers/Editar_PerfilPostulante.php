<?php

require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';

// Verificar si el usuario ha iniciado sesión (puedes agregar más lógica aquí)
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
$telefono = $_POST["Telefono"];
$dni = $_POST["DNI"];
$ciudad = $_POST["Ciudad"];
$emailContacto = $_POST["Email"];

// $cv = $_POST["cv"];

$cv = file_get_contents($_FILES["cv"]["tmp_name"]);



$nuevaPassword = $_POST["password"];


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
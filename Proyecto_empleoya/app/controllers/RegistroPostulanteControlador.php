<?php
require_once '../../config/app.php';
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $DNI= $_POST["DNI"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $telefono = $_POST["telefono"];
    $ciudad = $_POST["ciudad"];
    
session_start();
    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar al postulante.
    session_start();
    if ($usuarioModelo->registrarPostulante($nombre, $apellido, $DNI, $email, $hashPassword, $telefono, $ciudad)) {

        
        header('Location: ' . SERVERURL . 'app/views/Postulante/Registropostulante.php');
        $_SESSION['Registroexitoso'] = true;
    } else {
        header('Location: ' . SERVERURL . 'app/views/Postulante/Registropostulante.php');
        $_SESSION['Registroincorrecto'] = true;

        // echo "Error en el registro de postulante. El correo electrónico ya existe.";
    }
    
}





?>

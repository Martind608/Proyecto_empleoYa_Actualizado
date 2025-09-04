<?php
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $errors = [];

    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$nombre) { $errors[] = "Nombre inválido."; }

    $apellido = filter_input(INPUT_POST, "apellido", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$apellido) { $errors[] = "Apellido inválido."; }

    $DNI = filter_input(INPUT_POST, "DNI", FILTER_SANITIZE_NUMBER_INT);
    if (!$DNI) { $errors[] = "DNI inválido."; }

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (!$email) { $errors[] = "Correo electrónico inválido."; }

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$password) { $errors[] = "Contraseña inválida."; }

    $telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$telefono) { $errors[] = "Teléfono inválido."; }

    $ciudad = filter_input(INPUT_POST, "ciudad", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$ciudad) { $errors[] = "Ciudad inválida."; }

    if ($errors) {
        echo implode('<br>', $errors);
        exit;
    }

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar al postulante.

    if ($usuarioModelo->registrarPostulante($nombre, $apellido, $DNI, $email, $hashPassword, $telefono, $ciudad)) {
        
        header("Location: ../../public/index.php");
    } else {
        
        echo "Error en el registro de postulante. El correo electrónico ya existe.";
    }
    
}

?>

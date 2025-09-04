<?php
require_once '../../config/database.php'; 
require_once '../models/UsuarioModelo.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $errors = [];

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (!$email) { $errors[] = "Correo electrónico inválido."; }

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$password) { $errors[] = "Contraseña inválida."; }

    $nombre = filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$nombre) { $errors[] = "Nombre inválido."; }

    $apellido = filter_input(INPUT_POST, "apellido", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$apellido) { $errors[] = "Apellido inválido."; }

    $telefono = filter_input(INPUT_POST, "telefono", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$telefono) { $errors[] = "Teléfono inválido."; }

    $verificado = 1;
    
    if ($errors) {
        echo implode('<br>', $errors);
        exit;
    }

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.

    if ($usuarioModelo->registrarAutoridad($nombre,$email, $hashPassword, $telefono, $apellido,$verificado)) {
        
        echo "Registro de la aut fue exitoso. Puedes iniciar sesión ahora.";
    } else {
    
        echo "Error en el registro de la aut. El correo electrónico ya existe.";
    }
    
}





?>
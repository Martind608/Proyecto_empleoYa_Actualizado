<?php
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../../config/csrf.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    verify_csrf_token();
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $errors = [];

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    if (!$email) { $errors[] = "Correo electrónico inválido."; }

    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$password) { $errors[] = "Contraseña inválida."; }
    $verificado = 1;
    
    if ($errors) {
        echo implode('<br>', $errors);
        exit;
    }


    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.
    if ($usuarioModelo->registrarAdministrador($email, $hashPassword,$verificado)) {
        
        echo "Registro del ADM exitoso. Puedes iniciar sesión ahora.";
    } else {
    
        echo "Error en el registro del ADM. El correo electrónico ya existe.";
    }
    
}

?>
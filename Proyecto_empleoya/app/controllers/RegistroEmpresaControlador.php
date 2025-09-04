<?php
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $errors = [];

    $RazonSocial = filter_input(INPUT_POST, "RazonSocial", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$RazonSocial) { $errors[] = "Razón social inválida."; }

    $SitioWeb = filter_input(INPUT_POST, "SitioWeb", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$SitioWeb) { $errors[] = "Sitio web inválido."; }

    $CUIT = filter_input(INPUT_POST, "CUIT", FILTER_SANITIZE_NUMBER_INT);
    if (!$CUIT) { $errors[] = "CUIT inválido."; }

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

    // Llama a la función en el modelo para registrar a la Empresa.

    if ($usuarioModelo->registrarEmpresa($RazonSocial, $SitioWeb, $CUIT, $email, $hashPassword, $telefono, $ciudad)) {
        header("Location: ../public/index.php");
        // echo "Registro de la Empresa exitoso. Puedes iniciar sesión ahora.";
    } else {
    
        echo "Error en el registro de la Empresa. El correo electrónico ya existe.";
    }
    
}


?>

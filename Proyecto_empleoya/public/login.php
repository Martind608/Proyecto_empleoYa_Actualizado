<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/UsuarioModelo.php';
require_once __DIR__ . '/../app/controllers/UsuarioControlador.php';
require_once __DIR__ . '/../config/csrf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && filter_input(INPUT_POST, "FROM_LOGIN") === "true") {
        verify_csrf_token();
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);

    $email = filter_input(INPUT_POST, "Email", FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, "HashConstrasenia", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$email || !$password) {
        echo "Datos de inicio de sesión inválidos.";
        exit;
    }

    if ($controller->verificarCredenciales($email, $password)) {
        $tipoUsuario = $controller->obtenerTipoUsuario($email);
        $verificado = $controller->verificarVerificado($email);

        if ($verificado) {
            session_start();
            $_SESSION['Email'] = $email;
            $_SESSION['tipo_usuario'] = $tipoUsuario;

            if ($tipoUsuario === 'postulante') {
                header("Location: ../public/index.php");
                exit();
            } elseif ($tipoUsuario === 'empresa') {
                header("Location: ../public/index.php");
                exit();
            } elseif ($tipoUsuario === 'administrador') {
                header("Location: ../app/views/admin/InicioAdmin.php");
                exit();
            } elseif ($tipoUsuario === 'autoridad') {
                header("Location: ../app/views/Autoridad/InicioAutoridad.php");
                exit();
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            header("Location: verificacion.php");
            exit();
        }
    } else {
        header("Location: credencialesincorrectas.php");
        exit();
    }
}
?>
<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/UsuarioModelo.php';
require_once __DIR__ . '/../app/controllers/UsuarioControlador.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["FROM_LOGIN"]) && $_POST["FROM_LOGIN"] === "true") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);

    $email = $_POST["Email"];
    $password = $_POST["HashConstrasenia"];

    if ($controller->verificarCredenciales($email, $password)) {
        $tipoUsuario = $controller->obtenerTipoUsuario($email);
        $verificado = $controller->verificarVerificado($email);

        if ($verificado) {
            session_start();
            $_SESSION['Email'] = $email;
            $_SESSION['tipo_usuario'] = $tipoUsuario;

            if ($tipoUsuario === 'postulante') {
                header("Location: ../app/views/index.php");
                exit();
            } elseif ($tipoUsuario === 'empresa') {
                header("Location: ../app/views/index.php");
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
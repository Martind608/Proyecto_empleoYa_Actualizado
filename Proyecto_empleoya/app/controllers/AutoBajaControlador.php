<?php
session_start();
require_once '../../config/app.php';
require_once('./../../config/database.php');
require_once('UsuarioControlador.php');
require_once(__DIR__ . '/../models/UsuarioModelo.php');

// Verificar si se ha enviado la acción "accion" desde el formulario
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
    $idUsuario = $_GET['IDUsuario'];

    // Conectar a la base de datos
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);

    // Validar el valor de la variable $idUsuario
    if (!is_numeric($idUsuario)) {
        echo "Error: IDUsuario no es un número válido.";
        return;
    }

    if ($accion === 'dardebajapostulante') {
        $usuarioModelo->BajaVerificado($idUsuario);
        $usuarioModelo->FechaBajaPostulante($idUsuario);
        session_unset(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        session_start();
        $_SESSION['Dadodebajapostulante'] = true;
        header('Location: ' . SERVERURL . 'app/views/login.php');



        exit();
    } elseif ($accion === 'dardebajaempresa') {
        $usuarioModelo->BajaVerificado($idUsuario);
        $usuarioModelo-> Cancelarofertasporbajadeempresa($idUsuario);
        $usuarioModelo-> FechaBajaEmpresa($idUsuario);
        // Cerrar la sesión del usuario

        session_unset(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión
        session_start();
        $_SESSION['Dadodebajaempresa'] = true;
        header('Location: ' . SERVERURL . 'app/views/login.php');



        exit();
    } else {
        // Acción desconocida
        echo "Error: Acción desconocida.";
    }
} else {
    // Error: "accion" no está definida en la solicitud
    echo "Error: Acción no está definida en la solicitud.";
}
?>
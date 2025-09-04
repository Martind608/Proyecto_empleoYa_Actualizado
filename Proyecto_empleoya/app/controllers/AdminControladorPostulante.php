
<?php
session_start();

require_once ('./../../config/database.php');
require_once ('UsuarioControlador.php');
require_once(__DIR__ . '/../models/UsuarioModelo.php');

// Verificar si se ha enviado la acción "accion" desde el formulario
$accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$idUsuario = filter_input(INPUT_POST, 'IDUsuario', FILTER_VALIDATE_INT);
if ($accion && $idUsuario !== false) {

    // Conectar a la base de datos
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);

    // Validar el valor de la variable $idUsuario
    if ($idUsuario === false) {
        echo "Error: IDUsuario no es un número válido.";
        return;
    }

    // Realizar acciones según el valor de "accion"
    if ($accion === 'alta') {
        // Realizar la acción de "Alta" aquí
        if ($usuarioModelo->actualizarVerificado($idUsuario)) {
            header("Location: ../views/admin/AltasPostulante.php");
        } else {
            // Error: no se pudo actualizar
            echo "Error: no se pudo actualizar el campo 'verificado' para Alta.";
        }
    } elseif ($accion === 'rechazar') {
        $usuarioModelo->EliminarPostulante($idUsuario);
        header("Location: ../views/admin/AltasPostulante.php");
        echo "Acción de Rechazar realizada.";
    }elseif ($accion === 'dardebaja') {
        $usuarioModelo->actualizarVerificadoados($idUsuario);
        header("Location: ../views/admin/BajasPostulante.php");
        echo "Acción de baja realizada.";
     } else {
        // Acción desconocida
        echo "Error: Acción desconocida.";
    }
} else {
    // Error: "accion" o IDUsuario no válidos
    echo "Error: Acción o ID de usuario no válidos.";
}
?>

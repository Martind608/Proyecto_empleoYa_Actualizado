
<?php
session_start();

require_once ('./../../config/database.php');
require_once ('UsuarioControlador.php');
require_once(__DIR__ . '/../models/UsuarioModelo.php');

// Verificar si se ha enviado la acción "accion" desde el formulario
if (isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $idUsuario = $_POST['IDUsuario'];

    // Conectar a la base de datos
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $controller = new UsuarioControlador($usuarioModelo);

    // Validar el valor de la variable $idUsuario
    if (!is_numeric($idUsuario)) {
        echo "Error: IDUsuario no es un número válido.";
        return;
    }

    // Realizar acciones según el valor de "accion"
    if ($accion === 'baja') {
        // Realizar la acción de "Alta" aquí
        if ($usuarioModelo->BajaVerificado($idUsuario)) {
            header("Location: ../views/admin/BajasAutoridad.php");
        } else {
            // Error: no se pudo actualizar
            echo "Error: no se pudo actualizar el campo 'verificado' para Alta.";
        }

} else {
    // Error: "accion" no está definida en la solicitud
    echo "Error: Acción no está definida en la solicitud.";
}
}
?>
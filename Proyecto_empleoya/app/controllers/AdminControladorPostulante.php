
<?php
session_start();
require_once '../../config/app.php';
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
    if ($accion === 'alta') {
        // Realizar la acción de "Alta" aquí
        if ($usuarioModelo->actualizarVerificado($idUsuario)) {
              header('Location: ' . SERVERURL . 'app/views/admin/AltasPostulante.php');
        } else {
            // Error: no se pudo actualizar
            echo "Error: no se pudo actualizar el campo 'verificado' para Alta.";
        }
    } elseif ($accion === 'rechazar') {
        $usuarioModelo->EliminarPostulante($idUsuario);
          header('Location: ' . SERVERURL . 'app/views/admin/AltasPostulante.php');
        echo "Acción de Rechazar realizada.";
    }elseif ($accion === 'dardebaja') {
        $usuarioModelo->BajaVerificado($idUsuario);
        $usuarioModelo->FechaBajaPostulante($idUsuario);
        unset($_SESSION['postulantesEncontrados']);
     header('Location: ' . SERVERURL . 'app/views/admin/BajasPostulante.php');
        echo "Acción de baja realizada.";
     } else {
        // Acción desconocida
        echo "Error: Acción desconocida.";
    }
} else {
    // Error: "accion" no está definida en la solicitud
    echo "Error: Acción no está definida en la solicitud.";
}
?>

<?php
require_once '../../config/app.php';

require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';
require_once '../controllers/UsuarioControlador.php';

// Inicializa la instancia del controlador y el modelo
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);
$controller = new UsuarioControlador($usuarioModelo);

// Obtén el valor de IDEmpleo desde la URL usando $_GET
if (isset($_GET['IDEmpleo'])) {
    $IDEmpleo = $_GET['IDEmpleo'];

    // Llama a la función para cerrar la propuesta
    if ($controller->cerrarpropuesta($IDEmpleo)) {
        $_SESSION['exito_actualizacion'] = true;
        header('Location: ' . SERVERURL . 'app/views/Empresa/Mispropuestas.php');
    } else {
        // Manejar errores si la actualización falla
        echo "Error al actualizar los datos.";
    }
} else {
    // Manejar el caso en el que IDEmpleo no se haya recibido en la URL
    echo "IDEmpleo no recibido en la URL.";
}
?>

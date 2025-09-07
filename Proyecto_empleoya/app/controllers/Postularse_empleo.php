<?php
session_start();
require_once '../../config/app.php';
require_once '../../config/database.php';
require_once 'UsuarioControlador.php';

// Inicializa tus objetos y controlador
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);
$controller = new UsuarioControlador($usuarioModelo);

// Verifica si se envió el formulario y se desea postularse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'postularse') {
    // Obtén otros datos del formulario, como IDEmpleo e IDPostulante
    $IDEmpleo = $_POST['IDEmpleo'];
    $IDPostulante = $_POST['IDPostulante'];

    // Llama a la función en el controlador para insertar la postulación
    $resultado = $controller->insertarPostulacion($IDEmpleo, $IDPostulante);

    // Puedes manejar el resultado aquí y mostrar un mensaje de éxito o error al usuario
    if ($resultado) {
        header('Location: ' . SERVERURL . 'public/index.php');
        session_start();
        $_SESSION['postulacionexitosa'] = true;
        // echo '¡Postulación exitosa!';
    } else {
        echo 'Error al postularse';
    }
}
?>
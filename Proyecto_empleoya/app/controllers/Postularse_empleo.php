<?php

require_once '../../config/database.php';
require_once 'UsuarioControlador.php';
require_once '../../config/csrf.php';
// Inicializa tus objetos y controlador
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);
$controller = new UsuarioControlador($usuarioModelo);

// Verifica si se envió el formulario y se desea postularse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && filter_input(INPUT_POST, 'accion') === 'postularse') {
        verify_csrf_token();
    // Obtén otros datos del formulario de manera segura, como IDEmpleo e IDPostulante
    $IDEmpleo = filter_input(INPUT_POST, 'IDEmpleo', FILTER_VALIDATE_INT);
    $IDPostulante = filter_input(INPUT_POST, 'IDPostulante', FILTER_VALIDATE_INT);

    if ($IDEmpleo === false || $IDPostulante === false) {
        echo 'Datos de postulación inválidos.';
        exit;
    }
    // Llama a la función en el controlador para insertar la postulación
    $resultado = $controller->insertarPostulacion($IDEmpleo, $IDPostulante);

    // Puedes manejar el resultado aquí y mostrar un mensaje de éxito o error al usuario
    if ($resultado) {
            header("Location: ../../public/index.php?postulacion=exito");

        // echo '¡Postulación exitosa!';
    } else {
        echo 'Error al postularse';
    }
}
?>
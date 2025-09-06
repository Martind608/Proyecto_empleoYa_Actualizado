<?php
// Inicia la sesión si aún no se ha iniciado
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

require_once __DIR__ . '/../../config/app.php';
// Redirecciona al usuario a la página de inicio
header('Location: ' . SERVERURL . 'app/views/index.php');
exit();
?>

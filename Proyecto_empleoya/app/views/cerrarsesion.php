<?php
// Inicia la sesión si aún no se ha iniciado
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Redirecciona al usuario a la página de inicio de sesión
header("Location: ../../public/index.php");
exit();
?>

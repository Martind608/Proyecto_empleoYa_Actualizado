<?php
require_once '../../config/database.php'; // Asegúrate de tener el archivo de configuración de la base de datos
require_once '../models/UsuarioModelo.php'; // Asegúrate de tener el modelo de usuario importado
require_once '../../config/csrf.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    verify_csrf_token();
    
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    session_start();
    
    // Obtener los datos del formulario de manera segura
    $email = $_SESSION['Email'];
    $errors = [];

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$titulo) { $errors[] = "Título inválido."; }

    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$descripcion) { $errors[] = "Descripción inválida."; }

    $ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$ubicacion) { $errors[] = "Ubicación inválida."; }

    $modalidad = filter_input(INPUT_POST, 'modalidad', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$modalidad) { $errors[] = "Modalidad inválida."; }

    $tipo_empleo = filter_input(INPUT_POST, 'tipo_empleo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$tipo_empleo) { $errors[] = "Tipo de empleo inválido."; }

    $salario = filter_input(INPUT_POST, 'salario', FILTER_VALIDATE_FLOAT);
    if ($salario === false) { $errors[] = "Salario inválido."; }

    $fecha_public = filter_input(INPUT_POST, 'fecha_public', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (!$fecha_public) { $errors[] = "Fecha inválida."; }

    if ($errors) {
        echo implode('<br>', $errors);
        exit;
    }

    // Llama a la función para guardar la oferta de trabajo
    if ($usuarioModelo->cargarTrabajoEmpresa($email, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public)) {
          // Registro exitoso, redirige a una página de inicio de sesión o muestra un mensaje de éxito.
          header("Location: ../views/Empresa/PostularTrabajo.php");
    } else {
            // Error en el registro, muestra un mensaje de error.
            echo "Error al publicar la oferta de trabajo";
        }

}

?>
    
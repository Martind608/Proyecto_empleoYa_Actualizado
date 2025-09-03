<?php
require_once '../../config/database.php'; // Asegúrate de tener el archivo de configuración de la base de datos
require_once '../models/UsuarioModelo.php'; // Asegúrate de tener el modelo de usuario importado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    session_start();
    
     // Obtener los datos del formulario
     $email = $_SESSION['Email'];
     $titulo = $_POST['titulo'];
     $descripcion = $_POST['descripcion'];
     $ubicacion = $_POST['ubicacion'];
     $modalidad = $_POST['modalidad'];
     $tipo_empleo = $_POST['tipo_empleo'];
     $salario = isset($_POST['salario']) ? $_POST['salario'] : 0;
     $fecha_public = $_POST['fecha_public'];


    // Llama a la función para guardar la oferta de trabajo
    if ($usuarioModelo->cargarTrabajoEmpresa($email,$titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public)) {
          // Registro exitoso, redirige a una página de inicio de sesión o muestra un mensaje de éxito.
          header("Location: ../views/Empresa/PostularTrabajo.php");
    } else {
            // Error en el registro, muestra un mensaje de error.
            echo "Error al publicar la oferta de trabajo";
        }

}

?>
    
<?php
session_start();
require_once '../../config/app.php';
require_once ('./../../config/database.php');
require_once ('UsuarioControlador.php');
require_once(__DIR__ . '/../models/UsuarioModelo.php');

// Crear una instancia del modelo
$db = new Database();
$usuarioModelo = new UsuarioModelo($db);

// Obtener todos los postulantes pendientes
//$postulantesPendientes = $usuarioModelo->obtenerPostulantesAlta();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener la palabra clave del formulario
    $palabraClave = $_POST['palabraClave'];

    // Crear una instancia del modelo y llamar al método buscarPostulante
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);
    $postulantesEncontrados = $usuarioModelo->buscarPostulante($palabraClave);
    $_SESSION['postulantesEncontrados'] = $postulantesEncontrados;
    // Redirige a la vista con los resultados
    header('Location: ' . SERVERURL . 'app/views/admin/BajasPostulante.php');
    exit();
}

// Si no se realizó una búsqueda, pasar todos los postulantes pendientes a la vista
include('../views/admin/BajasPostulante.php');
?>

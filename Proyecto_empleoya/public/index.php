<?php
require_once __DIR__ . '/../app/controllers/HomeControlador.php';

// Crear instancia del controlador y ejecutar la acción index
$controlador = new HomeControlador();
$controlador->index();
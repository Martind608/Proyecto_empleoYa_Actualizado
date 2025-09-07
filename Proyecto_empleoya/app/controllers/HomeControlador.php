<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/UsuarioModelo.php';
require_once __DIR__ . '/UsuarioControlador.php';

class HomeControlador {
    private $usuarioControlador;
    private $usuarioModelo;

    public function __construct() {
        $db = new Database();
        $this->usuarioModelo = new UsuarioModelo($db);
        $this->usuarioControlador = new UsuarioControlador($this->usuarioModelo);
    }

    public function index() {
        // Iniciar sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Preparar datos para la vista
        $datosVista = $this->prepararDatosIndex();
        
        // Hacer el controlador disponible para la vista
        $controlador = $this;

        // Cargar la vista con los datos
        require __DIR__ . '/../views/index.php';
    }

    private function prepararDatosIndex() {
        $datos = [];
        
        // Obtener información del usuario logueado
        $datos['idPostulante'] = null;
        $datos['emailPostulante'] = null;
        $datos['tipoUsuario'] = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : null;
        
        if (isset($_SESSION['Email'])) {
            $datos['emailPostulante'] = $_SESSION['Email'];
            $datos['idPostulante'] = $this->usuarioControlador->obtenerIDUsuario($_SESSION['Email']);
        }

        // Obtener ofertas y procesarlas
        $ofertas = $this->usuarioControlador->obtenerOfertas($this->usuarioModelo);
        $datos['ofertas'] = $this->procesarOfertas($ofertas, $datos['idPostulante']);
        $datos['ofertasReverso'] = array_reverse($datos['ofertas']);

        // Verificar si hay mensaje de postulación exitosa
        $datos['postulacionExitosa'] = isset($_SESSION['postulacionexitosa']) && $_SESSION['postulacionexitosa'] === true;
        
        // Limpiar la variable de sesión después de verificarla
        if ($datos['postulacionExitosa']) {
            $_SESSION['postulacionexitosa'] = false;
        }

        return $datos;
    }

    private function procesarOfertas($ofertas, $idPostulante) {
        $ofertasProcesadas = [];
        
        foreach ($ofertas as $oferta) {
            // Agregar nombre de empresa
            $oferta['nombreEmpresa'] = $this->usuarioControlador->obtenerNombreEmpresaPorID($oferta['IDEmpresa']);
            
            // Verificar si el usuario ya se postuló
            if ($idPostulante) {
                $oferta['usuarioYaPostulado'] = $this->usuarioControlador->usuarioYaPostulado($idPostulante, $oferta['IDEmpleo']);
            } else {
                $oferta['usuarioYaPostulado'] = false;
            }

            // Verificar si existe el flyer
            $oferta['flyerExiste'] = !empty($oferta['Flyer']) && file_exists($oferta['Flyer']);
            
            $ofertasProcesadas[] = $oferta;
        }
        
        return $ofertasProcesadas;
    }

    public function determinarHeader($tipoUsuario) {
        $headers = [
            'administrador' => 'Footer_Header/headerAdministrador.php',
            'autoridad' => 'Footer_Header/headerAutoridad.php',
            'empresa' => 'Footer_Header/headerEmpresa.php',
            'postulante' => 'Footer_Header/headerPostulante.php'
        ];
        
        return isset($headers[$tipoUsuario]) ? $headers[$tipoUsuario] : 'Footer_Header/header.php';
    }

    public function puedeVerMas($tipoUsuario) {
        $tiposPermitidos = ['postulante', 'empresa', 'administrador', 'autoridad'];
        return in_array($tipoUsuario, $tiposPermitidos);
    }

    public function puedeDescargarFlyer($tipoUsuario) {
        return $tipoUsuario === 'postulante';
    }

    public function puedePostularse($tipoUsuario, $usuarioYaPostulado) {
        return $tipoUsuario === 'postulante' && !$usuarioYaPostulado;
    }
}
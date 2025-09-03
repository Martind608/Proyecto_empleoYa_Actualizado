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
        session_start();

        $idPostulante = null;
        if (isset($_SESSION['Email'])) {
            $idPostulante = $this->usuarioControlador->obtenerIDUsuario($_SESSION['Email']);
        }

        $ofertas = $this->usuarioControlador->obtenerOfertas($this->usuarioModelo);
        foreach ($ofertas as &$oferta) {
            $oferta['nombreEmpresa'] = $this->usuarioControlador->obtenerNombreEmpresaPorID($oferta['IDEmpresa']);
            if ($idPostulante) {
                $oferta['usuarioYaPostulado'] = $this->usuarioControlador->usuarioYaPostulado($idPostulante, $oferta['IDEmpleo']);
            } else {
                $oferta['usuarioYaPostulado'] = false;
            }
        }
        unset($oferta); // break reference

        require __DIR__ . '/../views/index.php';
    }
}

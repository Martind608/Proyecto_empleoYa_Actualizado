<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../models/UsuarioModelo.php');
require_once(__DIR__ . '/UsuarioControlador.php');
require_once(__DIR__ . '/../../config/app.php');

class LoginControlador
{
    private $usuarioControlador;

    public function __construct()
    {
        $db = new Database();
        $usuarioModelo = new UsuarioModelo($db);
        $this->usuarioControlador = new UsuarioControlador($usuarioModelo);
    }

    public function login()
    {
        session_start();

        $email = $_POST['Email'];
        $password = $_POST['HashConstrasenia'];

        if ($this->usuarioControlador->verificarCredenciales($email, $password)) {
            $tipoUsuario = $this->usuarioControlador->obtenerTipoUsuario($email);
            $verificado = $this->usuarioControlador->verificarVerificado($email);

            if ($verificado === 1) {
                $_SESSION['Email'] = $email;
                $_SESSION['tipo_usuario'] = $tipoUsuario;
                    header('Location: ' . SERVERURL . 'app/views/index.php'); // Redirige a la página de postulante
                exit();
            } elseif ($verificado === 0) {
                $_SESSION['credencialnoverificada'] = true;
                header('Location: ' . SERVERURL . 'app/views/login.php');
                exit();
            } else {
                $_SESSION['Usuariodadodebaja'] = true;
                header('Location: ' . SERVERURL . 'app/views/login.php');
                exit();
            }
        } else {
            $_SESSION['credencialesincorrectas'] = true;
                header('Location: ' . SERVERURL . 'app/views/login.php');
            exit();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['FROM_LOGIN']) && $_POST['FROM_LOGIN'] === 'true') {
    $loginControlador = new LoginControlador();
    $loginControlador->login();
}
?>
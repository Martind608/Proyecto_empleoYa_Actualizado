<?php
require_once(__DIR__ . '/../../config/database.php');
// require_once '../../config/database.php';
// require_once '../models/UsuarioModelo.php';
require_once(__DIR__ . '/../models/UsuarioModelo.php');

class UsuarioControlador
{
    private $usuarioModelo;

    public function __construct($usuarioModelo)
    {
        $this->usuarioModelo = $usuarioModelo;
    }


    public function verificarCredenciales($email, $password)
    {
        // Verifica las credenciales en el modelo
        $verificado = $this->usuarioModelo->verificarCredenciales($email, $password);

        // Si las credenciales son válidas, establece la variable de sesión `verificado`
        if ($verificado) {
            $_SESSION['verificado'] = true;
        }

        return $verificado;
    }


    public function obtenerTipoUsuario($email)
    {
        return $this->usuarioModelo->obtenerTipoUsuario($email);
    }
    public function verificarVerificado($email)
    {
        return $this->usuarioModelo->verificarVerificado($email);
    }

    //DESDE ACA COMIENZA EL EDITAR EMPRESA
    public function obtenerDatosUsuario($email)
    {
        return $this->usuarioModelo->obtenerDatosUsuario($email);
    }

    // Función para obtener datos de empresa por ID de usuario
    public function obtenerDatosEmpresa($idUsuario)
    {
        return $this->usuarioModelo->obtenerDatosEmpresa($idUsuario);
    }

    // Función para obtener datos de contacto por ID
    public function obtenerDatosContacto($idContacto)
    {
        return $this->usuarioModelo->obtenerDatosContacto($idContacto);
    }

    //Metodo para listar empresas
    public function listarEmpresas($modelo)
    {
        $empresas = $this->usuarioModelo->obtenerListaEmpresas();
        return $empresas;
    }
    public function listarEmpresasVerificadas($modelo)
    {
        $empresasVerificadas = $modelo->obtenerEmpresasVerificadas();
        return $empresasVerificadas;
    }


    public function actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword)
    {
        return $this->usuarioModelo->actualizarDatosEmpresaContacto($email, $razonSocial, $sitioWeb, $cuit, $emailContacto, $telefono, $ciudad, $nuevaPassword);
    }

    //FUNCIONES PARA EDITAR PERFIIL POSTULANTE
    public function obtenerDatosPostulante($idUsuario)
    {
        return $this->usuarioModelo->obtenerDatosPostulante($idUsuario);
    }

    public function actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $rutaCompleta, $nuevaPassword)
    {
        return $this->usuarioModelo->actualizarDatosPostulanteContacto($email, $nombre, $apellido, $telefono, $dni, $ciudad, $emailContacto, $rutaCompleta, $nuevaPassword);
    }
    
    public function existeCorreoElectronico($email)
    {
        return $this->usuarioModelo->existeCorreoElectronico($email);
    }



    //FUNCIONES PARA EDITAR PERFIIL AUTORIDAD
    public function obtenerDatosAutoridad($idUsuario)
    {
        return $this->usuarioModelo->obtenerDatosAutoridad($idUsuario);
    }
    public function actualizarDatosAutoridadContacto($email, $nombre, $apellido, $emailContacto, $telefono, $ciudad, $nuevaPassword)
    {
        return $this->usuarioModelo->actualizarDatosAutoridadContacto($email, $nombre, $apellido, $emailContacto, $telefono, $ciudad, $nuevaPassword);
    }








    public function cargarTrabajoEmpresa($idEmpresa, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public, $rutaCompleta)
    {
        return $this->usuarioModelo->cargarTrabajoEmpresa($idEmpresa, $titulo, $descripcion, $ubicacion, $modalidad, $tipo_empleo, $salario, $fecha_public, $rutaCompleta);
    }

    public function obtenerOfertas($modelo)
    {
        $ofertas = $modelo->obtenerDatosDeOfertas();
        return $ofertas;
    }

    public function obtenerOfertaEspecifica($modelo, $IDEmpleo)
    {
        $oferta = $modelo->obtenerDatosDeOfertaEspecifica($IDEmpleo);
        return $oferta;
    }


    public function obtenerNombreEmpresaPorID($idEmpresa)
    {
        return $this->usuarioModelo->obtenerNombreEmpresaPorID($idEmpresa);
    }

    public function obtenerIDUsuario($email)
    {
        return $this->usuarioModelo->obtenerIDUsuario($email);
    }

    // Utilizo esto en boton de postularse
    public function insertarPostulacion($IDEmpleo, $IDPostulante)
    {
        return $this->usuarioModelo->insertarPostulacion($IDEmpleo, $IDPostulante);
    }

    // Método en el controlador para verificar si el usuario ya está postulado para un trabajo
    public function usuarioYaPostulado($IDPostulante, $IDEmpleo)
    {
        return $this->usuarioModelo->usuarioYaPostulado($IDPostulante, $IDEmpleo);
    }

    public function obtenerMisPropuestas($IDEmpresa)
    {
        $ofertas = $this->usuarioModelo->obtenerMisPropuestas($IDEmpresa);
        return $ofertas;
    }


    //Metodo para cambiar la verificación 

    public function ListarVerficados($modelo)
    {
        $usuario = $this->usuarioModelo->obtenerUsuariosVerificados();
        return $usuario;
    }

    // Método para eliminar un usuario
    public function eliminarUsuario($IDUsuario)
    {
        // Llama al método del modelo para eliminar el usuario
        if ($this->usuarioModelo->eliminarUsuario($IDUsuario)) {
            // Éxito: el usuario se eliminó correctamente
            return true;
        } else {
            // Error: no se pudo eliminar el usuario
            return false;
        }
    }

    public function verMisPostulados($IDEmpleo)
    {
        $mispostulados = $this->usuarioModelo->verMisPostulados($IDEmpleo);
        return $mispostulados;
    }

    public function cerrarpropuesta($IDEmpleo)
    {
        return $this->usuarioModelo->cerrarpropuesta($IDEmpleo);
    }


    public function obtenerNombreCVActual($IDUsuario)
    {
        return $this->usuarioModelo->obtenerNombreCVActual($IDUsuario);
    }



}



// Aca se hace el login (Solo entra aca si se manda desde el formulario de login)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["FROM_LOGIN"]) && $_POST["FROM_LOGIN"] === "true") {
        session_start();
        $db = new Database();
        $usuarioModelo = new UsuarioModelo($db);
        $controller = new UsuarioControlador($usuarioModelo);

        $email = $_POST["Email"];
        $password = $_POST["HashConstrasenia"];

        if ($controller->verificarCredenciales($email, $password)) {
            // Obtén el tipo de usuario
            $tipoUsuario = $controller->obtenerTipoUsuario($email);

            // Verifica si el usuario está verificado
            $verificado = $controller->verificarVerificado($email);

            if ($verificado === 1) {
                // Inicia la sesión
                session_start();
                // Guarda el tipo de usuario en la sesión
                $_SESSION['Email'] = $email;
                $_SESSION['tipo_usuario'] = $tipoUsuario;

                // Redirige según el tipo de usuario
                if ($tipoUsuario === 'postulante') {
                    header("Location: ../views/index.php"); // Redirige a la página de postulante
                    exit();
                } elseif ($tipoUsuario === 'empresa') {
                    header("Location: ../views/index.php"); // Redirige a la página de empresa
                    exit();
                } elseif ($tipoUsuario === 'administrador') {
                    header("Location: ../views/index.php"); // Redirige a la página de empresa
                    exit();
                } elseif ($tipoUsuario === 'autoridad') {
                    header("Location: ../views/index.php"); // Redirige a la página de empresa
                    exit();
                } else {
                    // Redirige a la página principal o muestra un mensaje para otros tipos de usuario
                    header("Location: index.php");

                    exit();
                }
            } elseif ($verificado === 0) {
                // El usuario no está verificado, redirige a la página de verificación
                header("Location: ../views/login.php");
                $_SESSION['credencialnoverificada'] = true;

                exit();
            } else {

                // El usuario a sido dado de baja, redirige a la página de login
                header("Location: ../views/login.php");
                $_SESSION['Usuariodadodebaja'] = true;

                exit();
            }
        } else {
            // Las credenciales son incorrectas, redirige a la página "nose.php"
            $_SESSION['credencialesincorrectas'] = true;
            header("Location: ../views/login.php");

            exit();
        }
    }
}


?>
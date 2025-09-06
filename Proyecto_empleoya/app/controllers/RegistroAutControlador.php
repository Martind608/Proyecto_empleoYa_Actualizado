<?php
require_once '../../config/app.php';
require_once '../../config/database.php';
require_once '../models/UsuarioModelo.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $email = $_POST["email"];
    $password = $_POST["password"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $cargo =$_POST["cargo"];
    $ciudad=$_POST["ciudad"];
    $verificado = 1;
   

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.
   
    if ($usuarioModelo->registrarAutoridad($nombre,$email, $hashPassword, $telefono, $apellido,$verificado, $cargo, $ciudad)) {
        session_start();
        $_SESSION['altaexitosa'] = true;
        header('Location: ' . SERVERURL . 'app/views/admin/AltasAut.php');

        
    } else {
        session_start();
        $_SESSION['error_registro_autoridad'] = "El correo electrónico ya existe.";
        header('Location: ' . SERVERURL . 'app/views/admin/AltasAut.php');
    }
    
}





?>
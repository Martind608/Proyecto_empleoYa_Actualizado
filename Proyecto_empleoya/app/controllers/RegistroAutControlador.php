<?php
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
    $verificado = 1;
   

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.
   
    if ($usuarioModelo->registrarAutoridad($nombre,$email, $hashPassword, $telefono, $apellido,$verificado)) {
        
        echo "Registro de la aut fue exitoso. Puedes iniciar sesión ahora.";
    } else {
       
        echo "Error en el registro de la aut. El correo electrónico ya existe.";
    }
    
}





?>
<?php
require_once '../../config/database.php'; 
require_once '../models/UsuarioModelo.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $email = $_POST["email"];
    $password = $_POST["password"];
    $verificado = 1;
    
   

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.
   
    if ($usuarioModelo->registrarAdministrador($email, $hashPassword,$verificado)) {
        
        echo "Registro del ADM exitoso. Puedes iniciar sesión ahora.";
    } else {
       
        echo "Error en el registro del ADM. El correo electrónico ya existe.";
    }
    
}





?>
<?php
require_once '../../config/database.php'; 
require_once '../models/UsuarioModelo.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $usuarioModelo = new UsuarioModelo($db);

    $RazonSocial = $_POST["RazonSocial"];
    $SitioWeb = $_POST["SitioWeb"];
    $CUIT = $_POST["CUIT"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $telefono = $_POST["telefono"];
    $ciudad = $_POST["ciudad"];
    
   

    // Hashear la contraseña antes de guardarla en la base de datos.
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Llama a la función en el modelo para registrar a la Empresa.
   
    if ($usuarioModelo->registrarEmpresa($RazonSocial, $SitioWeb, $CUIT, $email, $hashPassword, $telefono, $ciudad)) {
         header("Location: ../public/index.php");
        // echo "Registro de la Empresa exitoso. Puedes iniciar sesión ahora.";
    } else {
       
        echo "Error en el registro de la Empresa. El correo electrónico ya existe.";
    }
    
}





?>

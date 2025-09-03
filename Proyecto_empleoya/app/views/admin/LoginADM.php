<?php
if (isset($_POST['FROM_LOGIN']) && $_POST['FROM_LOGIN'] === "true") {
    // Obtén los datos del formulario
    $email = $_POST['Email'];
    $password = $_POST['HashConstrasenia'];

    // Realiza la autenticación del administrador, por ejemplo, con una función de verificación
    // Puedes utilizar tu función personalizada para verificar las credenciales del administrador
    // ...
    
    // Supongamos que $usuario_autenticado es verdadero si las credenciales son válidas
    $usuario_autenticado = true;

    if ($usuario_autenticado) {
        // Redirige al administrador a la página de inicio de administrador (InicioAdmin.php)
        header("Location: InicioAdmin.php");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Las credenciales son incorrectas, puedes mostrar un mensaje de error o realizar otras acciones aquí
        $error_message = "Credenciales incorrectas. Por favor, inténtelo de nuevo.";
    }
} 
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Iniciar Sesión</title>
</head>

<body>
    <header class=''>
        <nav class="navbar navbar-expand-lg bg-light p-3 pt-0">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Empleo Ya!</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Login Administrador</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <button class='btn-secondary button border-0' type='submit'>Cerrar Sesion</button>

                </div>
                </ul>
            </div>
            </div>
        </nav>
    </header>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Login</h3>
                    <form action="../../controllers/UsuarioControlador.php" method="POST"
                        class='d-flex flex-column gap-15'>
                        <input class="form-control" type='Email' name='Email' placeholder='Email' required />
                        <input class="form-control" type='password' name='HashConstrasenia' placeholder='Contraseña'
                            required />
                        <p class="btn">Olvidaste tu contraseña?</p>
                        <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                            <button class='button border-0' type='submit'>Iniciar Sesión</button>
                            <input type="hidden" name="FROM_LOGIN" value="true">
                        </div>
                    </form>
                    <?php
                    // Muestra el mensaje de error si hay uno
                    if (isset($error_message)) {
                        echo "<p class='text-danger'>$error_message</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>


    <footer class='py-4 footer'>
        <div class='row'>
            <div class='col-12'>
                <p class='text-center mb-0 text-white'>&copy; 2023; Desarrollado por Juan23</p>
            </div>
        </div>
    </footer>
</body>

</html>
<?php
if (filter_input(INPUT_POST, 'FROM_LOGIN') === "true") {
    // Obtén los datos del formulario de manera segura
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'HashConstrasenia', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$email || !$password) {
        $error_message = "Datos de inicio de sesión inválidos.";
    } else {
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

    }

?>

<?php require_once "../Footer_Header/header.php"; ?>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Login</h3>
                    <form action="../../../public/login.php" method="POST"
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


<?php require_once '../Footer_Header/footer.php'; ?>
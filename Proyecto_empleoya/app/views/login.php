<?php
$title = 'Iniciar Sesion';
require_once 'Footer_Header/header.php';
?>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class='row'>
        <div class='col-12'>
            <div class='auth-card'>
                <h3 class='text-center mb-3'>Iniciar Sesion</h3>
                <form action="../../public/login.php" method="POST" class='d-flex flex-column gap-15'>
                    <div class="mb-3">
                        <label for="Email" class="form-label">Email</label>
                        <input class="form-control form-control-lg" type='Email' name='Email' id='Email' placeholder='Email' />
                        <small class="form-text text-muted">Ingrese su correo electrónico.</small>
                    </div>
                    <div class="mb-3">
                        <label for="HashConstrasenia" class="form-label">Contraseña</label>
                        <input class="form-control form-control-lg" type='HashConstrasenia' name='HashConstrasenia' id='HashConstrasenia' placeholder='Contraseña' />
                        <small class="form-text text-muted">Ingrese su contraseña.</small>
                    </div>
                    <p class="btn">Olvidaste tu contraseña?</p>
                    <div class='d-flex justify-content-center gap-15 align-items-center'>
                        <button class='btn-primary-custom' type='submit'>Iniciar Sesion</button>
                        <input type="hidden" name="FROM_LOGIN" value="true">
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php require_once 'Footer_Header/footer.php'; ?>
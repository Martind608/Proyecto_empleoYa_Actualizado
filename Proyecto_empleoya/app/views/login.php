<?php
$title = 'Iniciar Sesion';
require_once 'Footer_Header/header.php';
 ?>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class='row'>
            <div class='col-12'>
                <div class='auth-card'>
                    <h3 class='text-center mb-3'>Iniciar Sesion</h3>
                    <form action="../controllers/UsuarioControlador.php" method="POST"
                        class='d-flex flex-column gap-15'>
                        <Input class="form-control" type='Email' name='Email' placeholder='Email' />
                        <Input class="form-control" type='HashConstrasenia' name='HashConstrasenia'
                            placeholder='Contraseña' />
                        <p class="btn">Olvidaste tu contraseña?</p>
                        <div class='d-flex justify-content-center gap-15 align-items-center'>
                            <button class='button border-0' type='submit'>Iniciar Sesion</button>
                            <input type="hidden" name="FROM_LOGIN" value="true">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php require_once 'Footer_Header/footer.php'; ?>
<?php
session_start();
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
if (isset($_SESSION['tipo_usuario'])) {
    require_once "../Footer_Header/headerAdministrador.php";;

?>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='row'>
                <div class='col-12'>
                    <div class='auth-card'>
                        <h3 class='text-center mb-3'>Alta Autoridad</h3>
                        <?php
                            // Verifica si existe una variable de sesión de error y muestra el mensaje de error si es así
                            if (isset($_SESSION['error_registro_autoridad'])) {
                                echo "<div class='alert alert-danger'>" . $_SESSION['error_registro_autoridad'] . "</div>";
                                // Luego, borra la variable de sesión de error para que el mensaje no se muestre en futuras visitas
                                unset($_SESSION['error_registro_autoridad']);
                            }
                    ?>
                        <form action="../../controllers/RegistroAutControlador.php" method="post"
                            class='d-flex flex-column gap-15'>
                            <input class='form-control' type='text' name='nombre' placeholder='Nombre' required/>
                            <input class='form-control' type='text' name='apellido' placeholder='Apellido' required/>
                            <input class='form-control' type='text' name='cargo' placeholder='Cargo' required/>
                            <input class='form-control' type='number' name='telefono' placeholder='Telefono' required/>
                            <input class='form-control' type='text' name='ciudad' placeholder='Ciudad' required/>
                            <input class='form-control' type='email' name='email' placeholder='Correo Electronico' required/>
                            <input class='form-control' type='password' name='password' placeholder='Contraseña' required/>

                            <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                                <a href="<?php echo $url; ?>/app/views/index.php">
                                    <button class='button border-0' type='submit'>Dar de Alta</button>
                                </a>
                            </div>
                            
                            <!-- MODAL Confirmacion Alta(Ventana Emergente) -->
                            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                        <div class="modal-header d-flex justify-content-center">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cuenta Creada Correctamente
                                            </h1>
                                        </div>

                                        <div class="modal-body d-flex justify-content-center">
                                            <p>Recibira un mail cuando su cuenta se haya dado de alta</p>
                                        </div>

                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-primary"
                                                data-bs-dismiss="modal">Aceptar</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php
                            // Verifica si la variable de sesión existe y es verdadera para mostrar el modal
                                if (isset($_SESSION['altaexitosa']) && $_SESSION['altaexitosa'] === true) {

                                    ?>
                                    <!-- MODAL (Ventana Emergente) -->
                                    <div class="modal fade" id="altaexitosa" tabindex="-1" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"> Autoridad dada de alta ¡con éxito!</h1>
                                                    <!-- Cambia el título aquí -->
                                                </div>
                                                <div class="modal-footer d-flex justify-content-center">
                                                    <a href="#" class="btn btn-primary text-white" data-bs-dismiss="modal">Aceptar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        // Utiliza JavaScript para mostrar el modal cuando la página se carga
                                        $(document).ready(function () {
                                            $('#altaexitosa').modal('show');
                                        });

                                    </script>
                                    <?php
                                    // Luego, borra la variable de sesión para que el mensaje no se muestre en futuras visitas
                                    $_SESSION['altaexitosa'] = false;
                                }
                                ?>
                        </form>
                        
                    </div>
                    
                </div>
                
            </div>
            <div class='p-1'>
                <a href="<?php echo $url; ?>public/index.php">
                    <button type="button" class='button border-0 m-1'>
                        Volver
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <?php
        require_once "../Footer_Header/footer.php";
    ?>
    
</body>

</html>

<?php }?>
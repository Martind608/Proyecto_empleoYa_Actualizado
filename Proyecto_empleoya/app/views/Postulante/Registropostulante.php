<?php 
$title = 'Crear Cuenta';
require_once '../Footer_Header/header.php'; ?>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class='row'>
        <div class='col-12'>
            <div class='auth-card'>
                <h3 class='text-center mb-3'>Registro Postulante</h3>
                <form action="../../controllers/RegistroPostulanteControlador.php" method="post" class='d-flex flex-column gap-15'>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control form-control-lg" type="text" name="nombre" id="nombre" placeholder="Nombre" />
                        <small class="form-text text-muted">Ingrese su nombre.</small>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input class="form-control form-control-lg" type="text" name="apellido" id="apellido" placeholder="Apellido" />
                        <small class="form-text text-muted">Ingrese su apellido.</small>
                    </div>
                    <div class="mb-3">
                        <label for="DNI" class="form-label">DNI</label>
                        <input class="form-control form-control-lg" type="number" name="DNI" id="DNI" placeholder="DNI" />
                        <small class="form-text text-muted">Ingrese su DNI.</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control form-control-lg" type="email" name="email" id="email" placeholder="Email" />
                        <small class="form-text text-muted">Ingrese su correo electrónico.</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input class="form-control form-control-lg" type="text" name="password" id="password" placeholder="Contraseña" />
                        <small class="form-text text-muted">Cree una contraseña.</small>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input class="form-control form-control-lg" type="text" name="telefono" id="telefono" placeholder="Telefono" />
                        <small class="form-text text-muted">Ingrese su número de teléfono.</small>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input class="form-control form-control-lg" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" />
                        <small class="form-text text-muted">Ingrese su ciudad.</small>
                    </div>
                    <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                        <button class='btn-primary-custom' type='submit'>Crear Cuenta</button>
                    </div>
                        <div>

                        </div>

                    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content ">
                                <div class="modal-header d-flex justify-content-center">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cuenta Creada Correctamente</h1>
                                </div>
                                <div class="modal-body d-flex justify-content-center">
                                    <p>Recibira un mail cuando su cuenta se haya dado de alta</p>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                
                    </form>
                </div>
            </div>

        </div>
        <div class='p-1'>
            <a href="../../public/index.php">
                <button type="button" class='btn-primary-custom m-1'>
                    Volver
                </button>
            </a>
        </div>
    </section>

<?php require_once '../Footer_Header/footer.php'; ?>
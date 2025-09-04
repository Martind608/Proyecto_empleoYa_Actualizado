<?php 
$title = 'Crear Cuenta';
require_once '../Footer_Header/header.php'; ?>


<section class='login-wrapper py-5 home-wrapper-2'>
    <div class='row'>
        <div class='col-12'>
            <div class='auth-card'>
                <h3 class='text-center mb-3'>Registro Empresa</h3>
                <form action="../../controllers/RegistroEmpresaControlador.php" method="post" class='d-flex flex-column gap-15'>
                    <div class="mb-3">
                        <label for="RazonSocial" class="form-label">Razón Social</label>
                        <input class='form-control form-control-lg' type='text' name='RazonSocial' id='RazonSocial' placeholder='Razon Social' />
                        <small class="form-text text-muted">Ingrese la razón social.</small>
                    </div>
                    <div class="mb-3">
                        <label for="SitioWeb" class="form-label">Sitio Web</label>
                        <input class='form-control form-control-lg' type='text' name='SitioWeb' id='SitioWeb' placeholder='Sitio Web' />
                        <small class="form-text text-muted">Ingrese el sitio web de la empresa.</small>
                    </div>
                    <div class="mb-3">
                        <label for="CUIT" class="form-label">CUIT</label>
                        <input class='form-control form-control-lg' type='number' name='CUIT' id='CUIT' placeholder='CUIT' />
                        <small class="form-text text-muted">Ingrese el número de CUIT.</small>
                    </div>
                    <div class="mb-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input class='form-control form-control-lg' type='text' name='ciudad' id='ciudad' placeholder='Ciudad' />
                        <small class="form-text text-muted">Ingrese la ciudad.</small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input class='form-control form-control-lg' type='text' name='email' id='email' placeholder='Correo Electronico' />
                        <small class="form-text text-muted">Ingrese un correo válido.</small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input class='form-control form-control-lg' type='password' name='password' id='password' placeholder='Contraseña' />
                        <small class="form-text text-muted">Cree una contraseña.</small>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input class='form-control form-control-lg' type='number' name='telefono' id='telefono' placeholder='Telefono' />
                        <small class="form-text text-muted">Ingrese un número de contacto.</small>
                    </div>
                    <div class='mt-3 d-flex justify-content-center gap-15 align-items-center'>
                        <button class='btn-primary-custom' type='submit'>Crear Cuenta</button>
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

                    </div>
                </form>
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
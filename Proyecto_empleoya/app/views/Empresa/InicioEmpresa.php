
<?php require_once '../Footer_Header/headerEmpresa.php'; ?>
    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center'>
                <h1>Inicio Empresa</h1>
            </div>
            <div class='d-flex justify-content-center'>
                <a href="../../views/Empresa/PostularTrabajo.php">
                    <div class='btn button m-1'>
                        <h1>Publicar Oferta</h1>
                    </div>
                </a>
                
                <a href="../../views/Empresa/Mispropuestas.php">
                    <button class='btn button m-1'>
                        <h1>Mis Propuestas</h1>
                    </button>
                </a>
                
                <button class='btn button m-1 d-flex align-items-center' type="button" data-bs-toggle="modal" data-bs-target="#configuracion">
                    Notificaciones
                </button>
                
                <!-- MODAL Ventana Emergente -->
                <div class="modal fade" id="configuracion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content ">
                                <div class="modal-header d-flex justify-content-center">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        Pulse aceptar para desactivar las notificaciones
                                    </h1>
                                </div>
    
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                                </div>
                                
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </section>


<?php require_once '../Footer_Header/footer.php'; ?>
<?php require_once '../Footer_Header/headerPostulante.php'; ?>

    <section class='login-wrapper p-1 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center p-1 m-1'>
                <h1>Detalle Oferta</h1>
            </div>
            <div class="card p-2 m-2">
                <div class="card-body">
                    <h5 class="card-title">Nombre de la Oferta</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Modalidad</h6>
                    <p class="card-text">Descripción de la oferta de trabajo. Esta es una descripción breve de la posición y sus responsabilidades.</p>
                    <p class="card-text"><strong>Requisitos:</strong> Lista de requisitos para la posición, como habilidades, experiencia, etc.</p>
                    <p class="card-text"><strong>Ubicación:</strong> Ciudad, Estado</p>
                    <p class="card-text"><strong>Fecha de Publicación:</strong> Fecha de publicación de la oferta</p>
                    <button class='btn btn-primary' href="#" data-bs-toggle="modal" data-bs-target="#postular">Postular</button>
            
                    <!-- MODAL (ventana emergente) -->
                    <div class="modal fade" id="postular" tabIndex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body d-flex justify-content-center">
                                    <h2>Postulacion realizada con exito!</h2>
                                </div>
                
                                <div class="modal-footer d-flex justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
        <div class='p-1'>
            <a href="../../views/index.php">
            <button  type="button" class='button border-0 m-1'>
                Volver
            </button>
            </a>
        </div>
    </section>

<?php require_once '../Footer_Header/footer.php'; ?>
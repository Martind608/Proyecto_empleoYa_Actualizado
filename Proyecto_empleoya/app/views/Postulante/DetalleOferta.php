<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Detalle Oferta</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light ">
            <div class="container-fluid d-flex justify-content-center p-2 m-2">
                <div class="row align-items-center flex-column p-1 m-1">
            <div class="col text-center">
                <a class="navbar-brand p-0 m-0" href="../../views/index.php">Empleo Ya!</a>
            </div>
            <div class="col text-center">
                <img src="../../../public/img/iconoJuan23.png" height="50" width="50">
            </div>
          </div>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">¿Quienes Somos?</a>
                </li>
              </ul>  -->

                <ul class="navbar-nav ms-auto ">
                    <div class='d-flex justify-content-center gap-15 align-items-center'>
                        <a href="../../views/index.php">
                            <button class='btn-secondary button border-0' type='submit'>Cerrar Sesion</button>
                        </a>
                    </div>              
                </ul>
            </div>
            </div>
        </nav>
    </header>

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

    <footer class='py-4 footer'>
        <div class='row'>
            <div class='col-12'>
                <p class='text-center mb-0 text-white'>&copy; 2023: Desarrollado por Juan23</p>
            </div>
        </div>
    </footer>
</body>
</html>
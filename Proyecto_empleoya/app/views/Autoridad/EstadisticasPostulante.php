<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Estadisticas Postulante</title>
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

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='d-flex justify-content-center'>
                <h1>Estadisticas Postulantes</h1>
            </div>
    
            <div class='d-flex justify-content-center'>
                <nav class="navbar bg-light ">
                    <div class="container-fluid d-flex justify-content-center">
                        <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Nombre o DNI" aria-label="Search"/>
                        <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>
    
                    <div class="container mt-1">
                        <div class="row">
                        
                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Apellido</h5>
                                            <h4 class="card-title">Nombre</h4>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php" class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mb-4">
                                <div class="container mt-5">
                                    <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                        <div class="d-flex justify-content-center align-items-center" style="width: 64px; height: 64px;">
                                            <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                        </div>
                                        
                                        <div class="card-body text-center">
                                            <h4 class="card-title">Apellido</h4>
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Edad:</p>
                                            <p class="card-text">E-mail:</p>
                                        </div>
                                        
                                        <a href="../../views/Autoridad/DetallePostulante.php"class="d-flex justify-content-center m-2">
                                            <button class="btn btn-primary">Ver mas</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
    
                    <div class='p-5'>
                        <a href="../../views/Autoridad/InicioAutoridad.php">
                            <button type="button" class='button border-0 m-1'>
                                Volver
                            </button>
                        </a>
                    </div>
                    
                </nav>
            </div>
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
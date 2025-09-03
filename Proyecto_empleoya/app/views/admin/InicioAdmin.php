<?php require_once '../Footer_Header/headerAdministrador.php'; ?>

    <section class='login-wrapper py-5 home-wrapper-2'>
        <div class="container-xxl">
            <div class='mb-5 pb-5'>
                <div class='d-flex justify-content-center'>
                    <h1>Inicio Administrador</h1>
                </div>
                <div class='d-flex justify-content-center'>

                    <!-- Gestion de Empresas -->
                    <div class="dropdown p-1 m-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Gestion de Empresas
                        </button>
                        <ul class="dropdown-menu">
                            
                            <li><a class="dropdown-item" href="AltasEmpresa.php">Dar de Alta</a></li>
                            
                            
                            <li><a class="dropdown-item" href="BajasEmpresa.php">Dar de Baja</a></li>
                            
                        </ul>
                    </div>

                    <!-- Gestion de Postulantes -->
                    <div class="dropdown p-1 m-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Gestion de Postulantes
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="AltasPostulante.php">Dar de Alta</a></li>
                            <li><a class="dropdown-item" href="BajasPostulante.php">Dar de Baja</a></li>
                        </ul>
                    </div>

                    <!-- Gestion de Autroridades Salesianas -->
                    <div class="dropdown p-1 m-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Gestion de Autoridad
                        </button>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="RegistrarAut.php">Dar de Alta</a></li>
                            <li><a class="dropdown-item" href="BajasAutoridad.php">Dar de Baja</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php require_once '../Footer_Header/footer.php'; ?>
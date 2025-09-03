<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <link rel="stylesheet" href="../../../public/style/style.css">

    <title>Detalle Postulante</title>
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
            <div class='d-flex justify-content-start p-5 pt-0 pb-0'>
                <h1>Detalle Postulante: name</h1>
            </div>

            <div class="container-fluid p-5 pt-1">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Tarjeta -->
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <h5 class="card-title">Nombre</h5>
                                            <p class="card-text">Apellido</p>
                                            <p class="card-text">Edad: XX</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <!-- Gráfico -->
                        <canvas id="myChart" style="width: 100%; height: 400px;"></canvas>
                    </div>
                </div>
            </div>

            <div class='p-5'>
                <a href="../../views/Autoridad/EstadisticasPostulante.php">
                    <button  type="button" class='button border-0 m-1'>
                        Volver
                    </button>
                </a>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
    <script>
        const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'];
        const postulaciones = [12, 18, 24, 30, 20, 28];

        const ctx = document.getElementById('myChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: meses,
                datasets: [
                    {
                        label: 'Cantidad de Postulaciones',
                        data: postulaciones,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
</body>
</html>

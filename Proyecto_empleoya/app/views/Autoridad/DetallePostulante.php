<?php require_once '../Footer_Header/headerAutoridad.php'; ?>

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
                    <canvas id="myChart" class="chart-canvas"></canvas>  
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
<?php require_once '../Footer_Header/footer.php'; ?>
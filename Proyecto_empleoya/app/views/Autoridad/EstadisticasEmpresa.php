<?php
session_start();
?>

<?php
require_once "../Footer_Header/headerAutoridad.php";
require_once '../../../config/database.php';
require_once '../../controllers/AutoridadControlador.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['fechaInicio']) && isset($_POST['fechaFin'])) {
        $fechaInicio = $_POST['fechaInicio'];
        $fechaFin = $_POST['fechaFin'];

        $controlador = new Controlador();
        $resultados = $controlador->consultarBajasPorFechaEmpresas($fechaInicio, $fechaFin);

        // Ahora puedes usar $resultados para mostrar los datos en la tabla HTML
        // ...
    } else {
        echo "Por favor, ingrese las fechas de inicio y fin.";
    }
}

$controlador = new Controlador(); // Asegúrate de que la variable $controlador esté definida
$todasLasEmpresas = $controlador->obtenerTodasLasEmpresas();
?>

<body>

<section class='login-wrapper py-2 home-wrapper-2'>
    <div class="container mt-5">
        <h1 class="pt-2 d-flex justify-content-center">Consulta de bajas empresas por fecha</h1>

        <div class="p-5 d-flex justify-content-center">
            <form action="" method="post">
                <div class="d-flex ">
                    <div class="form-group p-2">
                        <label for="fechaInicio">Fecha de inicio:</label>
                        <input type="date" class="form-control p-3" id="fechaInicio" name="fechaInicio" required>
                    </div>

                    <div class="form-group p-2">
                        <label for="fechaFin">Fecha de fin:</label>
                        <input type="date" class="form-control p-3" id="fechaFin" name="fechaFin" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>
            </form>
        </div>

        <div class="container-fluid d-flex justify-content-center">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search"  id="busquedaInput" placeholder="Razon Social" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>

        <!-- Resultados -->
        <div class="mt-5" id="resultados">
            <!-- Aquí se mostrarán los resultados de la consulta -->
            <?php if (!empty($resultados)): ?>
                <h2>Resultados de los postulantes dados de baja:</h2>

                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Razon Social</th>
                            <th>SitioWeb</th>
                            <th>Fecha de Baja</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($resultados as $fila): ?>
                            <tr>
                                <td><?php echo $fila['RazonSocial']; ?></td>
                                <td><?php echo $fila['SitioWeb']; ?></td>
                                <td><?php echo $fila['Fecha_baja']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

                <button class="btn btn-secondary" id="cerrarResultados">Cerrar Resultados</button>
            <?php endif; ?>
        </div>

        
            <nav>
                    <div class="row d-flex justify-content-center" id="tarjetasEmpresas">
                        
                        <?php
                            if (isset($todasLasEmpresas) && is_array($todasLasEmpresas)) {
                                foreach ($todasLasEmpresas as $fila) {
                                    // Obtén el IDUsuario de la fila actual
                                    $IDUsuario = $fila['IDUsuario'];
                        ?>

                        <div class="col-md-3 mb-4 mb-3"> <!--estaba en col-md-5-->
                            
                                <div class="card d-flex flex-column align-items-center justify-content-center p-3">
                                    <div class="p-1">
                                        <img src="../../../public/img/usuario.png" alt="Imagen de usuario" class="img-fluid">
                                    </div>

                                    <h5 class="card-title p-1"><?php echo $fila['RazonSocial']; ?></h5>

                                    <a href="../../views/Autoridad/DetalleEmpresa.php?IDUsuario=<?php echo $IDUsuario; ?>" class="d-flex justify-content-center m-2">
                                        <button class="btn btn-primary">Ver mas</button>
                                    </a>
                                
                                </div>
                        </div>

                        <?php
                            }
                            } else {
                                echo "No hay resultados disponibles.";
                            }
                        ?>

            </nav>
        

        <div class='p-5'>
            <a href="<?php echo $url; ?>/app/views/index.php">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function filterCards() {
        var busqueda = document.getElementById("busquedaInput").value.toLowerCase();
        var tarjetas = document.querySelectorAll("#tarjetasEmpresas .col-md-3");

        tarjetas.forEach(function(tarjeta) {
            var razonSocial = tarjeta.querySelector(".card-title").textContent.toLowerCase();

            if (razonSocial.includes(busqueda)) {
                tarjeta.style.display = "block";
            } else {
                tarjeta.style.display = "none";
            }
        });
    }

    document.getElementById("busquedaInput").addEventListener("input", filterCards);
</script>
</body>
</html>

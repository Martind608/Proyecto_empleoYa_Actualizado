<?php
session_start();
?>

<?php
require_once "../Footer_Header/headerAutoridad.php";
require_once '../../../config/database.php';
require_once '../../controllers/AutoridadControlador.php';
$controlador = new Controlador();

// Obtiene el IDUsuario de la URL
if (isset($_GET['IDUsuario'])) {
    $IDUsuario = $_GET['IDUsuario'];

    // Establecer la conexión a la base de datos
    $db = new Database();
    $conn = $db->getConnection();
    $empresa = $controlador->obtenerInformacionEmpresa($IDUsuario);
    $ofertas = $controlador->obtenerOfertasActivas($IDUsuario);
}
?>

<body>
<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='d-flex justify-content-center'>
            <?php if (!empty($empresa) && isset($empresa['RazonSocial'])) : ?>
                <h1>Razon Social: <?php echo $empresa['RazonSocial']; ?></h1>
            <?php else : ?>
                <h1>Empresa no encontrada</h1>
            <?php endif; ?>
        </div>

        <div class="container-fluid">

                    <!-- Tarjeta -->
                    <div class="container container d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card text-center">
                                    <div class="">
                                        <?php if (!empty($empresa) && isset($empresa['RazonSocial'])) : ?>
                                            <h3 class="card-text"><strong>Razon Social: </strong><?php echo $empresa['RazonSocial']; ?></h3>
                                            <h3 class="card-text"><strong>Sitio Web: </strong><?php echo $empresa['SitioWeb']; ?></h3>
                                        <?php else : ?>
                                            <p class="card-text">No se encontraron datos de la empresa.</p>
                                        <?php endif; ?>
                                        <?php if (!empty($ofertas) && isset($ofertas['CantidadOfertas'])) : ?>
                                            <h4 class="card-text"><strong>Cantidad de Ofertas Publicadas: </strong><?php echo $ofertas['CantidadOfertas']; ?></h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ofertas -->
                    <div class="flex-column d-flex justify-content-start p-2 m-0">
                        <h2 class='d-flex justify-content-start p-1 m-0'>Ofertas Activas</h2>
                        <?php if (!empty($ofertas) && isset($ofertas['CantidadOfertas']) && $ofertas['CantidadOfertas'] > 0) : ?>
                        
                                <?php
                                $ofertas = $controlador->obtenerOfertas($IDUsuario);
                                    
                                foreach ($ofertas as $oferta) {
                                    echo "<table class='table table-bordered m-0'>";
                                        echo "<tbody>";
                                            echo '<form class="d-flex justify-content-start w-80 m-0"  enctype="multipart/form-data" >';
                                                echo '<div class="container cardsize p-1 d-flex justify-content-start m-0">';                                    
                                                    echo '<div class="card card-body border border-2 rounded w-100">';
                                                        echo '<h5 class="card-title">' . $oferta['Titulo'] . '</h5>';
                                                        echo '<p class="fecha p-3">' . $oferta['FechaPublicacion'] . '</p>';
                                                        echo '<p class="card-text"><strong>Modalidad: </strong>' . $oferta['Modalidad'] . '</p>';
                                                        echo '<p class="card-text"><strong>Ubicacion: </strong>' . $oferta['Ubicacion'] . '</p>';
                                                        echo '<p class="card-text"><strong>Tipo de Empleo: </strong>' . $oferta['TipoEmpleo'] . '</p>';
                                                        echo '<p class="card-text"><strong>Descripcion: </strong>' . $oferta['Descripcion'] . '</p>';
                                                        echo '<p class="card-text"><strong>Salario: $</strong>' . $oferta['Salario'] . '</p>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</form>';
                                        echo "</tbody>";
                                    echo "</table>";
                                }
                                ?>

                        <?php else : ?>
                        <p class='card-text p-3'><strong>No hay ofertas activas.</strong></p>
                        <?php endif; ?>
    
                    </div>
        </div>

        <div class='p-5 pt-1'>
            <a href="../../views/Autoridad/EstadisticasEmpresa.php">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
    
</body>
</html>
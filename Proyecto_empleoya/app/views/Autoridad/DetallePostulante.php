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
    $postulante = $controlador->obtenerInformacionPostulante($IDUsuario);
    $ofertas = $controlador->obtenerPostulacionesActivas($IDUsuario);
}
?>


<body>
<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='d-flex justify-content-center'>
            <?php if (!empty($postulante) && isset($postulante['Nombre'])) : ?>
                
                    <h1 class="d-flex justify-content-center">Detalle Postulante: </h1>
                
            <?php else : ?>
                <h1>Postulante no encontrado</h1>
            <?php endif; ?>
        </div>

        <div class="container-fluid">

                    <!-- Tarjeta -->
                    <div class="container d-flex justify-content-center">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card text-center">
                                    <div class="">
                                        <?php if (!empty($postulante) && isset($postulante['Apellido'])) : ?>
                                            <h3 class="card-text"><strong>Apellido: </strong> <?php echo $postulante['Apellido']; ?></h3>
                                            <h3 class="card-text"><strong>Nombre: </strong> <?php echo $postulante['Nombre']; ?></h3>
                                            <h4 class="card-text"><strong>DNI: </strong> <?php echo $postulante['DNI']; ?></h4>

                                        <?php else : ?>
                                            <p class="card-text">No se encontraron datos del postulante.</p>
                                        <?php endif; ?>
                                        <?php if (!empty($ofertas) && isset($ofertas['CantidadPostulaciones'])) : ?>
                                            <h4 class="card-text"><strong>Cantidad de Postulaciones: </strong> <?php echo $ofertas['CantidadPostulaciones']; ?></h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ofertas -->
                    <div class="flex-column d-flex justify-content-start p-2 m-0">
                        <h2 class='d-flex justify-content-start p-1 m-0'>Postulaciones</h2>
                        <?php
                            $result = $controlador->obtenerPostulaciones($IDUsuario, $conn);
                                if ($result->num_rows > 0) {
                                    echo "<table class='table table-bordered m-0'>";
                                        echo "<tbody>";

                                            while ($row = $result->fetch_assoc()) {
                                                echo '<form class="d-flex justify-content-start w-80 m-0"  enctype="multipart/form-data" >';
                                                    echo '<div class="container cardsize p-1 d-flex justify-content-start m-0">';                                    
                                                        echo '<div class="card card-body border border-2 rounded w-100">';
                                                                echo '<h5 class="card-title">' . $row['Titulo'] . '</h5>';
                                                                echo '<p class="fecha p-3"><strong></strong>' . $row['FechaPublicacion'] . '</p>';
                                                                echo '<p class="card-text"><strong>Modalidad: </strong>' . $row['Modalidad'] . '</p>';
                                                                echo '<p class="card-text"><strong> Ubicacion: </strong>' . $row['Ubicacion'] . '</p>';
                                                                echo '<p class="card-text"><strong>Tipo de Empleo: </strong>' . $row['TipoEmpleo'] . '</p>';
                                                                echo '<p class="card-text"><strong>Descripcion: </strong>' . $row['Descripcion'] . '</p>';
                                                                echo '<p class="card-text"><strong> Salario: $</strong>' . $row['Salario'] . '</p>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                echo '</form>';
                                            }

                                        echo "</tbody>";
                                    echo "</table>";
                                    
                                } else {
                                    echo "<p class='card-text p-3'><strong>No se registran postulaciones.</strong></p>";
                                }
                            ?>
                    </div>
                
        </div>

        <div class='p-5 pt-1'>
            <a href="../../views/Autoridad/EstadisticasPostulante.php">
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
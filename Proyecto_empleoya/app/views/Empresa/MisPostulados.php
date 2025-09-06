<?php
session_start();

// Verificar si se recibió el parámetro IDEmpleo en la URL
if (isset($_GET['IDEmpleo'])) {
    $IDEmpleo = $_GET['IDEmpleo'];

} else {

    echo 'No se proporcionó un IDEmpleo válido en la URL.';
}
?>



<?php
require_once "../Footer_Header/headerEmpresa.php";
?>

<section class='login-wrapper py-5 home-wrapper-2'>
    <div class="container-xxl">
        <div class='d-flex justify-content-center p-1'>
            <h1>Mis Postulados</h1>
        </div>

        <div class="p-5 pt-2">

            <div class="row p-0 m-0">
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Opcion</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Apellido</h2>
                </div>
                <div class="col d-flex justify-content-center border border-dark">
                    <h2>Nombre</h2>
                </div>
            </div>

            <?php

            require_once '../../../config/database.php';
            require_once '../../controllers/UsuarioControlador.php';

            $db = new Database();
            $usuarioModelo = new UsuarioModelo($db);
            $controller = new UsuarioControlador($usuarioModelo);
            $mispostulados = $usuarioModelo->verMisPostulados($IDEmpleo);
            ?>


            <?php if (!empty($mispostulados)): ?>
                <?php foreach ($mispostulados as $postulante): ?>
                    <div class="row p-0 m-0">

                        <div class="col d-flex align-items-center justify-content-center border border-dark">
                            <!-- Botón "Ver Perfil" con evento onClick -->
                            <a class="btn btn-primary p-1 m-1 btn-aceptar"
                                href="VerPerfilPostulado.php?IDUsuario=<?= $postulante['IDUsuario'] ?>">Ver perfil</a>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center border border-dark">
                            <?= $postulante['Apellido'] ?>
                        </div>
                        <div class="col d-flex align-items-center justify-content-center border border-dark">
                            <?= $postulante['Nombre'] ?>
                        </div>



                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No se encontraron postulantes para esta oferta.</p>
                <?php endif; ?>


                
            </div>
            <div class='p-1'>
                    <a href="Mispropuestas.php">
                        <button type="button" class='button border-0 m-1'>
                            Volver
                        </button>
                    </a>
                </div>
</section>

<!-- FOOTER -->
<?php
require_once "../Footer_Header/footer.php";
?>

</body>

</html>
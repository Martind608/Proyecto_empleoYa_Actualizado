<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pie de pagina</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../public/style/style.css">

</head>

<body>
    <?php
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/Proyecto_empleoya/Proyecto_empleoya"

        ?>
    <footer class="pie">
        <div class="group-1">
            <div class="box">
                <figure>
                    <a href="https://www.juan23.edu.ar/">
                        <img src="https://www.juan23.edu.ar/wp-content/uploads/2018/06/logo_juan23_white-1.png"
                            alt="logo" height="70" width="100">
                    </a>
                    <a href="https://www.unisal.edu.ar/">
                        <img src="https://www.unisal.edu.ar/wp-content/uploads/2018/06/logo_unisal_white.png.webp"
                            alt="logo" height="70" width="100">
                    </a>
                </figure>
            </div>
            <div class="box">
                <h2>Instituto Superior Juan XXIII</h2>
                <p>Vieytes 286, Bahía Blanca, Buenos Aires</p>
                <div class="box">
                
                <div class="red">
                    <a href="https://web.whatsapp.com/send?text=&phone=542914375398" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.instagram.com/juan23.edu.ar/" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/Juan23.ar/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/juan23ar" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                </div>

           
            </div>

            <br />
                <h2>Universidad Salesiana</h2>
                <p>Gorriti 1249, Bahía Blanca, Buenos Aires</p>
                <div class="box">
                
                <div class="red">
                    <a href="https://www.instagram.com/unisalar" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://www.facebook.com/unisalar" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/unisalar" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                </div>

              
            </div>

            </div>
            <div class="box">
                
             
                <h2>Sitios de interes</h2>
                <div class="group-3">
                    <a href="<?php echo $url; ?>/app/views/faqs.php">Preguntas Frecuentes</a>
                </div>
            </div>
        </div>
        <div class="group-2">
            <small> 2023 <b>Desarrollado por alumnos del Juan XXIII</b> - Todos los derechos Reservados.</small>
        </div>
    </footer>

</body>

</html>
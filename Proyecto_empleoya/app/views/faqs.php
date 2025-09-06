<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<?php 
require_once "Footer_Header/header.php";
?>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../../public/style/style.css">


    <title>FAQS</title>
</head>

<body>



<div class="container mt-5 mb-5">
    <h1 class="text-center">Preguntas frecuentes</h1>

    <div class="accordion" id="faqAccordion">
        <!-- Pregunta 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    ¿Como me creo un usuario?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta a la primera pregunta.
                </div>
            </div>
        </div>

        <!-- Pregunta 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    ¿Como me postulo a un trabajo?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta a la segunda pregunta.
                </div>
            </div>
        </div>

        <!-- Pregunta 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    ¿Como publicar una oferta de empleo?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta a la tercera pregunta.
                </div>
            </div>
        </div>

         <!-- Pregunta 3 -->
         <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse3">
                    ¿Como veo quienes se postularon a mi oferta?
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta.
                </div>
            </div>
        </div>

         <!-- Pregunta 3 -->
         <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse3">
                    ¿Como modifico mis datos personales?
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta.
                </div>
            </div>
        </div>

         <!-- Pregunta 3 -->
         <div class="accordion-item ">
            <h2 class="accordion-header" id="heading6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse3">
                    ¿Que es la bolsa de empleo?
                </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Respuesta.
                </div>
            </div>
        </div>
    </div>
</div>
 


    <!-- FOOTER -->
    <?php
        require_once "Footer_Header/footer.php";
    ?>
</body>

</html>
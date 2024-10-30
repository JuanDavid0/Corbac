<?php
$idModulo = consultaModulo("preguntasfrecuentes");
?>

<div id="faq-1-cont">
    <div class="titulo">
        <h1>Preguntas Frecuentes</h1>
    </div>
    <?php
    $consultapreguntasF = consultaPreguntasFrecuentes($idModulo, $con, $idioma);
    while ($respreguntasf = mysqli_fetch_array($consultapreguntasF)) {
    ?>
        <div class="faq-1-item">
            <button class="faq-question">
                <?php echo $respreguntasf['pregunta']; ?>
            </button>
            <div class="faq-answer">
                <p><?php echo $respreguntasf['respuesta']; ?></p>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const answer = button.nextElementSibling;

            button.classList.toggle('active');
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        });
    });
</script>
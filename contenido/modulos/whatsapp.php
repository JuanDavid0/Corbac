<?php
$idModulo = consultaModulo("whatsapp");
$consultageneral = consultaGeneral('whatsapp', $idioma);
$resgeneral = mysqli_fetch_array($consultageneral);
?>
<div>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="http://wa.me/57<?php echo $resgeneral['variable']?>" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>
</div>
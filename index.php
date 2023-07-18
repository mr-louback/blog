<?php
include 'index.html';
include 'system/Nucleus/RenderClass.php';
include 'system/Nucleus/Helpers.php';
$msg = new RenderClass();
$helper = new Helpers();
$texto = $helper->saudacao();
echo $msg->renderizar($texto);
echo $msg->renderizar($texto);
?>

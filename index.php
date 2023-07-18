<?php
include 'index.html';
include 'system/Nucleus/RenderClass.php';
include 'system/Nucleus/Helpers.php';

$msg = new RenderClass();
$helper1 = new Helpers();

$texto = $helper1->saudacao();
// $css = ;
echo $msg->renderizar($texto, $helper1->texto('alert alert-warning'));
echo $msg->renderizar($texto, $helper1->texto('alert alert-success'));
echo $msg->renderizar($texto, $helper1->texto('alert alert-danger'));
echo $msg->renderizar($texto, $helper1->texto('alert alert-info'));
echo $msg->renderizar($texto, $helper1->texto('alert alert-light'));
echo $msg->renderizar($texto, $helper1->texto('alert alert-dark'));

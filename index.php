<?php
include 'index.html';
include 'system/Nucleus/RenderClass.php';
include 'system/library/configuracao.php';
include 'system/Nucleus/Helpers.php';

$msg = new RenderClass();
$helper = new Helpers();

$texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut repellat dolorem atque tempore iure officia! Explicabo, cum inventore veritatis accusantium suscipit accusamus dolor minima maxime quo, tenetur fugit officia! Facilis.';

echo $msg->renderizar('sua string de escolha ' . $helper->saudacao(), 'alert alert-success');
echo $msg->renderizar('sua string de escolha', 'alert alert-dark');
echo $msg->renderizar($helper->saudacao(), 'alert alert-danger');
echo $msg->renderizar($helper->url('asdfdsfas'), 'alert alert-warning');
echo $msg->renderizar($helper->contaTempo('2022-06-08 H:i:s'), 'alert alert-primary');
echo $msg->renderizar($helper->formatarValor(10000), 'alert alert-light');
echo $msg->renderizar($helper->resumeTexto($texto, 330), 'alert alert-info');

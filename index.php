<?php
include 'index.html';
include 'system/library/configuracao.php';
include 'system/Nucleus/RenderClass.php';
include 'system/Nucleus/Helpers.php';

$render = new RenderClass();

$texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut repellat dolorem atque tempore iure officia! Explicabo, cum inventore veritatis accusantium suscipit accusamus dolor minima maxime quo, tenetuçãõr fugit officia! Facilis.';

echo $render->renderizar(Helpers::saudacao(), alert_danger);
echo $render->renderizar(Helpers::criarSlug($texto), alert_info);
echo $render->renderizar(Helpers::resumeTexto($texto, 150), alert_success);
echo $render->renderizar(Helpers::texto($texto), alert_warning);
echo $render->renderizar(Helpers::formatarValor(150), alert_dark);
echo $render->renderizar(Helpers::contaTempo('2020-06-05 13:30:00'), alert_primary);
echo $render->renderizar(Helpers::validaCpf('402.985.028-60'), alert_success);

// echo $render->renderizar(Helpers::validarEmail('email@email.com'), alert_success);
// echo $render->renderizar(Helpers::validarUrl(url('asdasdfdf')), alert_success);
// echo $render->renderizar(Helpers::url
// (criarSlug($texto)), alert_success);
// echo $render->renderizar(Helpers::resumeTexto($texto, 150), alert_success);
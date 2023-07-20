<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

SimpleRouter::setDefaultNamespace('system\Controller');
SimpleRouter::get(URL_BASE, 'SiteController@index');
SimpleRouter::get(URL_BASE . 'formCad', 'SiteController@formCad');
SimpleRouter::get(URL_BASE . 'formLog', 'SiteController@formLog');
try {
    SimpleRouter::start();
    
} catch (NotFoundHttpException $e) {
    $texto = 'Erro 404 - Página não encontrada.';
    http_response_code(404);
    echo "<div class=" . alert_danger . "style='display:flex;text-align:center;'>{$texto}</div>";
}

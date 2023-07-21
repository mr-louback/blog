<?php

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\SimpleRouter\Exceptions\HttpException;
use system\Nucleus\Helpers;

try {
    SimpleRouter::setDefaultNamespace('system\Controller');
    SimpleRouter::get(URL_BASE, 'SiteController@index');
    SimpleRouter::get(URL_BASE . 'formCad', 'SiteController@formCad');
    SimpleRouter::get(URL_BASE . 'formLog', 'SiteController@formLog');
    SimpleRouter::get(URL_BASE . 'erro', 'SiteController@erro');
    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    Helpers::redirect('erro');
}

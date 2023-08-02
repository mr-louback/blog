<?php

use Pecee\SimpleRouter\SimpleRouter;
use system\Nucleus\Helpers;

try {
    SimpleRouter::setDefaultNamespace('system\Controller');
    SimpleRouter::get(URL_BASE, 'SiteController@index');
    SimpleRouter::get(URL_BASE . 'formCad', 'SiteController@formCad');
    SimpleRouter::post(URL_BASE . 'formCadSent', 'SiteController@formCadSent');
    SimpleRouter::get(URL_BASE . 'formLog', 'SiteController@formLog');
    SimpleRouter::get(URL_BASE . 'post/{id}', 'SiteController@post');
    SimpleRouter::get(URL_BASE . 'categoria/{id}', 'SiteController@categoria');
    SimpleRouter::get(URL_BASE . 'erro', 'SiteController@erro');
    // separação de namespaces
    SimpleRouter::group(['namespace' => 'Admin'], function () {
        SimpleRouter::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
        // admin posts
        SimpleRouter::get(URL_ADMIN . 'posts/list', 'AdminPosts@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/cadastrar', 'AdminPosts@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/{id}', 'AdminPosts@editar');
        SimpleRouter::get( URL_ADMIN . 'posts/deletar/{id}', 'AdminPosts@deletar');        
        // admin categorias
        SimpleRouter::get(URL_ADMIN . 'categorias/list', 'AdminCategorias@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'categorias/cadastrar', 'AdminCategorias@cadastrar');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'categorias/{id}', 'AdminCategorias@editar');
        SimpleRouter::get( URL_ADMIN . 'categorias/deletar/{id}', 'AdminCategorias@deletar');
    });
    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    if (Helpers::localhost()) {
        echo $e;
    }
    Helpers::redirect('erro');
}

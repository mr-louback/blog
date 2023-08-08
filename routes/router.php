<?php

use Pecee\SimpleRouter\SimpleRouter;
use system\Nucleus\Helpers;

try {
    SimpleRouter::setDefaultNamespace('system\Controller');
    // SimpleRouter::post(URL_BASE . 'formCadSent', 'SiteController@formCadSent');
    SimpleRouter::get(URL_BASE . 'post/{id}', 'SiteController@post');
    // SimpleRouter::get(URL_BASE . 'categoria/{id}', 'SiteController@categoria');
    SimpleRouter::get(URL_BASE, 'SiteController@index');
    SimpleRouter::match(['get', 'post'], URL_BASE . 'register', 'SiteController@register');
    // SimpleRouter::get(URL_BASE . 'login', 'SiteController@login');
    // SimpleRouter::match(['get', 'post'], URL_BASE . 'login', 'SiteController@login');
    SimpleRouter::get(URL_BASE . 'erro', 'SiteController@erro');
    // separação de namespaces
    SimpleRouter::group(['namespace' => 'Admin'], function () {
        // admin login
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'login', 'AdminLogin@login');
        // admin dashboard
        SimpleRouter::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
        SimpleRouter::get(URL_ADMIN . 'logout', 'AdminDashboard@logout');
        SimpleRouter::get(URL_ADMIN . 'post/{id}', 'AdminDashboard@post');
        SimpleRouter::get(URL_ADMIN . 'register', 'AdminDashboard@register');
        // admin posts
        SimpleRouter::get(URL_ADMIN . 'posts/list', 'AdminPosts@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/register', 'AdminPosts@register');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/{id}', 'AdminPosts@edit');
        SimpleRouter::get(URL_ADMIN . 'posts/delete/{id}', 'AdminPosts@delete');
        // admin categorias
        SimpleRouter::get(URL_ADMIN . 'categories/list', 'AdminCategories@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'categories/register', 'AdminCategories@register');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'categories/{id}', 'AdminCategories@edit');
        SimpleRouter::get(URL_ADMIN . 'categories/deletar/{id}', 'AdminCategories@deletar');
    });
    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
    if (Helpers::localhost()) {
        echo $e;
    }
    Helpers::redirect('erro');
}

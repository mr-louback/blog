<?php

use Pecee\SimpleRouter\SimpleRouter;
use system\Nucleus\Helpers;

try {
    SimpleRouter::setDefaultNamespace('system\Controller');
    SimpleRouter::match(['get', 'post'],URL_BASE, 'SiteController@index');
    SimpleRouter::get(URL_BASE . 'post/{slug}', 'SiteController@post');
    SimpleRouter::get(URL_BASE . 'erro', 'SiteController@erro');
    // separação de namespaces
    SimpleRouter::group(['namespace' => 'Admin'], function () {
        // admin login
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'login', 'AdminLogin@login');
        // admin register
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'register', 'AdminLogin@register');
        // admin dashboard
        SimpleRouter::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
        SimpleRouter::get(URL_ADMIN . 'logout', 'AdminDashboard@logout');
        SimpleRouter::get(URL_ADMIN . 'post/{slug}', 'AdminDashboard@post');
        SimpleRouter::get(URL_ADMIN . 'category/{id}', 'AdminDashboard@category');
        SimpleRouter::get(URL_ADMIN . 'user/{id}', 'AdminDashboard@user');
        SimpleRouter::get(URL_ADMIN . 'erro', 'AdminDashboard@erro');
        // admin users
        SimpleRouter::get(URL_ADMIN . 'users/list', 'AdminUsers@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'users/register', 'AdminUsers@register');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'users/{id}', 'AdminUsers@edit');
        SimpleRouter::get(URL_ADMIN . 'users/delete/{id}', 'AdminUsers@delete');
        // admin posts
        SimpleRouter::get(URL_ADMIN . 'posts/list', 'AdminPosts@list');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/register', 'AdminPosts@register');
        SimpleRouter::match(['get', 'post'], URL_ADMIN . 'posts/{id}', 'AdminPosts@edit');
        SimpleRouter::get(URL_ADMIN . 'posts/delete/{id}', 'AdminPosts@delete');
        SimpleRouter::get(URL_ADMIN . 'erro', 'AdminPosts@erro');
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

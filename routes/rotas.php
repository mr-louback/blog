<?php
use Pecee\SimpleRouter\SimpleRouter;
SimpleRouter::setDefaultNamespace('system\Controller');
SimpleRouter::get(URL_BASE,'SiteController@index');
SimpleRouter::get(URL_BASE.'about','SiteController@about');
SimpleRouter::get(URL_BASE.'contact','SiteController@contact');
SimpleRouter::start();
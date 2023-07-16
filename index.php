<?php
include 'system/library/helpers.php';
include 'system/library/configuracao.php';
require_once 'vendor/autoload.php';

use Cocur\Slugify\Slugify\Slugify;

$string = "Texto                    Com Função ý ö %æßðñ/?°®ŧ←";
$slug = criarSlug($string);
echo $slug;
// $slugify = new Slugify();
// echo $slugify->slugify("Texto Com Função ý ö %");
// echo url('admin');

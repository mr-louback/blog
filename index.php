<?php
include 'system/library/helpers.php';
include 'system/library/configuracao.php';
require_once 'vendor/autoload.php';

// use Cocur\Slugify\Slugify;

$string = "<h1>Texto Com Função</h1>    ------------   !@#$%¨&*()æßð/?°®ŧ←↓đŋħˀĸ→←ŧ®°nµ”“©»ßðđªº·─ ̣°";
$slug = criarSlug($string);
echo $slug;
// $slugify = new Slugify();
// echo $slugify->slugify($string);
// echo url('admin');

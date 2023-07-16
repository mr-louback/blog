<?php

include 'system/library/helpers.php';
// use system\library\Mensagem;
// $msg = new Mensagem('message');
// echo $msg;

echo contaTempo('2023-07-15 21:46:40');

$num = 4000000;
echo formatarValor($num);


$texto = '<h1>texto simplificado para resumir</h1>';
echo resumeTexto($texto, 14);

// conta quantidade de caracteres e retira espaços
echo $strQuant = mb_strlen(trim($texto));
echo "<br>";

// recorta o texto em uma determinada posição
echo $strCort = mb_substr($texto, 3, 14);
echo "<br>";
var_dump(mb_strlen($strQuant));
echo "<br>";


// encontra uma ocorrência na posição indicada
echo $strOcorre = mb_strrpos($texto, 'm');
echo "<br>";

echo saudacao();
echo "<br>";
echo resumeTexto($texto, 19);

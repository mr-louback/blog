<?php
/**
 * Valida url
 * @param string $url
 * @return bool
 */
function url(string $url): bool
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

/**
 * Valida Email
 * @param string $url
 * @return bool
 */
function validarEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}


/**
 * Conta o tempo decorridos de uma data
 * @param string $data
 * @return string
 */
function contaTempo(string $data): string
{
    $agora = strtotime(date('Y-m-d H:i:s'));
    $tempo = strtotime($data);
    $segundos = $agora - $tempo;
    $minutos = round($segundos / 60);
    $horas = round($segundos / 3600);
    $dias = round($segundos / 86400);
    $semanas = round($segundos / 604800);
    $meses = round($segundos / 2419200);
    $anos = round($segundos / 29030400);
    if ($segundos <= 60) {
        return $segundos == 1 ? 'há 1 segundo' : 'há ' . $segundos . ' segundos';
    } elseif ($minutos <= 60) {
        return $minutos == 1 ? 'há 1 minuto' : 'há ' . $minutos . ' minutos';
    } elseif ($horas <= 24) {
        return $horas == 1 ? 'há 1 hora' : 'há ' . $horas . ' horas';
    } elseif ($dias <= 7) {
        return $dias == 1 ? 'há 1 dia' : 'há ' . $dias . ' dias';
    } elseif ($semanas <= 4) {
        return $semanas == 1 ? 'há 1 semana' : 'há ' . $semanas . ' semanas';
    } elseif ($meses <= 12) {
        return $meses == 1 ? 'há 1 mês' : 'há ' . $meses . ' meses';
    } else {
        return $anos == 1 ? 'há 1 ano' : 'há ' . $anos . ' anos';
    }
}

/**
 * Formata um valor em decimal
 * @param float $valor
 * @return string 
 */
function formatarValor(float $valor): string
{
    return number_format(($valor ? $valor : 0), 2, ',', '.');
}

/**
 * Escreve uma saudação conforme o horário
 * 
 * @return string $saudacao
 */
function saudacao(): string
{
    $hora = date('H');
    if ($hora >= 0 and $hora <= 5) {
        $saudacao = 'boa madrugada!';
    } elseif ($hora >= 6 and $hora <= 12) {
        $saudacao = 'bom dia!';
    } elseif ($hora >= 13 and $hora <= 18) {
        $saudacao = 'boa tarde!';
    } else {
        $saudacao = 'boa noite!';
    }
    return $saudacao;
}

/**
 * Resume um texto 
 * 
 * @param string $texto
 * @param int $limite
 * @param string $continue 
 * @return string
 */
function resumeTexto(string $texto, int $limite,  string $continue = '...'): string
{
    $textoLimpo = trim(strip_tags($texto));
    if (mb_strlen($textoLimpo) <= $limite) {
        return $textoLimpo;
    }
    $textoResumido = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));
    return $textoResumido . $continue;
}

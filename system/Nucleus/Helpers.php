<?php

namespace system\Nucleus;

use Connection;
use Exception;
use mysqli;
use system\Nucleus\Session;
use Pecee\Http\Request;

class Helpers
{

    public static function flash(): ?string
    {
        $session = new Session();
        if ($flash = $session->flash()){
            echo $flash;
        }
        return null;
    }

    public static function redirect(string $url = null)
    {
        header('HTTP/1.1 302 Found');
        $local = ($url ? self::url($url) : self::url(''));
        header("Location: {$local}");
        exit();
    }

    /**
     * verifica se é localhost
     * @param string
     * @return bool 
     */
    public static function localhost(): bool
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
        if ($servidor == 'localhost') {
            return true;
        }
        return false;
    }

    /**
     * Valida url
     * @param string $url
     * @return bool
     */
    public static function validarUrl(string $url): bool
    {
        if (mb_strlen($url) < 10) {
            return false;
        }

        if (!str_contains($url, '.')) {
            return false;
        }

        if (str_contains($url, 'http://') || str_contains($url, 'https://')) {
            return true;
        }
        return false;
    }

    /**
     * Valida url
     * @param string $url
     * @return bool
     */
    public static function validarUrlComFiltro(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    /**
     * Valida Email
     * @param string $url
     * @return bool
     */
    public static function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    /**
     * Valida um cpf
     * @param  string $cpf
     * @return bool
     */
    public static function validaCpf(string $cpf): bool
    {
        //  Retira outros caracteres que não sejam números
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        // Verifica se o comprimento é de 11 dígitos
        if (strlen($cpf) !== 11 or preg_match('/(\d)\1{10}/', $cpf)) {
            throw new Exception("Cpf precisa de 11 dígitos");
        }
        for ($t = 9; $t > 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf = !$d) {
                throw new Exception("Cpf precisa ser válido");
            }
        }
        return true;
    }

    /**
     * Cria um string amigável
     * @param string $string
     * @return string $slug
     */

    public static function criarSlug($string): string
    {
        // Remove a  da string
        $tags = strip_tags(trim($string));
        // Remove a acentuação da string
        $stringSemAcentos = \Normalizer::normalize($tags, \Normalizer::FORM_D);
        // Substitui os espaços em branco por traços
        $slug = preg_replace('/\s+/', '-', $stringSemAcentos);
        // Remove qualquer caractere que não seja letra, número ou traço
        $slug = preg_replace('/[^a-zA-Z0-9-]/', '', $slug);
        // Converte para letras minúsculas
        $slug = strtolower($slug);
        // Retira dois ou mais hífens
        $slug = str_replace(['-----', '----', '---', '--', '-'], '-', $slug);
        return $slug;
    }

    /**
     * Monta url de acordo com o ambiente
     * @param string
     * @return string 
     */
    public static function url(string $url): string
    {
        $servidor = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $ambiente = ($servidor == 'localhost' ? URL_DESENVOLVIMENTO : URL_PRODUCAO);
        if (str_starts_with($url, '/')) {
            return $ambiente . $url;
        }

        return $ambiente . '/' . $url;
    }

    /**
     * Conta o tempo decorridos de uma data
     * @param string $data
     * @return string
     */
    public static function contaTempo(string $data): string
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
    public static function formatarValor(float $valor): string
    {
        return number_format(($valor ? $valor : 0), 2, ',', '.');
    }

    /**
     * Escreve uma saudação conforme o horário
     * 
     * @return string $saudacao
     */
    public static function saudacao(): string
    {
        $hora = date('H');
        $saudacao = match (true) {
            $hora >= 0 and $hora <= 5 => 'boa madrugada!',
            $hora >= 6 and $hora <= 12 => 'bom dia!',
            $hora >= 13 and $hora <= 18 => 'boa tarde!',
            default => 'boa noite!'
        };
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
    public static function resumeTexto(string $texto, int $limite,  string $continue = '...'): string
    {
        $textoLimpo = trim(strip_tags($texto));
        if (mb_strlen($textoLimpo) <= $limite) {
            return $textoLimpo;
        }
        $textoResumido = mb_substr($textoLimpo, 0, mb_strrpos(mb_substr($textoLimpo, 0, $limite), ''));
        return $textoResumido . $continue;
    }
    public static function texto(string $name)
    {
        // if ($_SERVER['REQUEST_METHOD' === "POST"]) {
        //     $email = $_POST['email'];
        //     $senha = $_POST['passw'];
        //     $name = $_POST['nome'];
        //     return array($name, $email, $senha);
        // }
        return $name;
    }
}

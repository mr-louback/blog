<?php

namespace system\Nucleus;

class RenderClass
{
    private $texto;
    private $css;

    /**
     * Reinderiza uma div
     * @param string $texto
     * @param string $css
     * @return string 
     */
    public function renderizar(string $texto, string  $css): string
    {
        $this->css = $this->css($css);
        $this->texto = $this->texto($texto);
        return "<div class='{$this->css}' role='alert'><div class='container' role='alert'>{$this->texto}</div></div>";
    }
    /**
     * @param string $css
     * @return string
     */
    function css(string $css): string
    {
        return $this->css = $css;
    }
    /**
     * @param string $texto
     * @return string
     */
    function texto(string $texto): string
    {
        return $this->texto = $texto;
    }
}

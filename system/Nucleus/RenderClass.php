<!-- <link rel="stylesheet" href="style.css"> -->
<?php
// namespace system\Nucleus;
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
    public function renderizar($texto, $css): string
    {
        $this->css = $this->css($css);
        $this->texto = $texto;
        return "<div class='{$this->css}' role='alert'>{$this->texto}</div>";
    }

    /**
     * @param string $css
     * @return string
     */
    private function css(string $css): string
    {
        return $this->css = $css;
    }
}

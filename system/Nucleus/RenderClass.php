<!-- <link rel="stylesheet" href="style.css"> -->
<?php
class RenderClass
{
    private $texto;
    private $css;
    public function renderizar($texto, $css): string
    {
        $this->css = $this->css($css);
        $this->texto = $texto;
        return "<div class='{$this->css}' role='alert'>{$this->texto}</div>";
    }


    private function css($css)
    {
        return $this->css = $css;
    }
}

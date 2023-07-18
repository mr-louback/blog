<!-- <link rel="stylesheet" href="style.css"> -->
<?php
class RenderClass
{
    private $texto;
    private $css;
    public function renderizar($texto): string
    {
        $this->css = 'alert alert-danger';
        $this->texto = $texto;
        return "<div class='{$this->css}' role='alert'>{$this->texto}</div>";
    }
}

<?php

class Controlador
{
    private $render;
    public function __construct($render)
    {
        $texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut repellat dolorem atque tempore iure officia! Explicabo, cum inventore veritatis accusantium suscipit accusamus dolor minima maxime quo, tenetuçãõr fugit officia! Facilis.';
                
        echo $this->render = $render->renderizar(Helpers::saudacao(), alert_danger);
        echo $this->render = $render->renderizar(Helpers::saudacao(), alert_danger);
        echo $this->render = $render->renderizar(Helpers::criarSlug($texto), alert_info);
        echo $this->render = $render->renderizar(Helpers::resumeTexto($texto, 150), alert_success);
        echo $this->render = $render->renderizar(Helpers::texto($texto), alert_warning);
        echo $this->render = $render->renderizar(Helpers::formatarValor(150), alert_dark);
        echo $this->render = $render->renderizar(Helpers::contaTempo('2020-06-05 13:30:00'), alert_primary);        
        echo $this->render = $render->renderizar(Helpers::resumeTexto($texto, 150), alert_success);
    }
}

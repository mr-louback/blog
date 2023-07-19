<?php

namespace system\Controller;

use Helpers;
use RenderClass;

include 'system/Nucleus/RenderClass.php';
include 'system/Nucleus/Controlador.php';

class SiteController
{

    public function index(): void
    {
        $render = new RenderClass();
        echo $render->renderizar(Helpers::criarSlug('texto para slug'), alert_info);
        echo "pagina index";
    }
    public function about(): void
    {
        $texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut repellat dolorem atque tempore iure officia! Explicabo, cum inventore veritatis accusantium suscipit accusamus dolor minima maxime quo, tenetuçãõr fugit officia! Facilis.';
        $render = new RenderClass();
        echo $render->renderizar(Helpers::saudacao(), alert_primary);
        echo $render->renderizar(Helpers::criarSlug('texto para slug'), alert_warning);
        echo "pagina contact";
        echo $render->renderizar(Helpers::texto($texto), alert_warning);
    }
    public function contact(): void
    {
        $render = new RenderClass();
        $texto = 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut repellat dolorem atque tempore iure officia! Explicabo, cum inventore veritatis accusantium suscipit accusamus dolor minima maxime quo, tenetuçãõr fugit officia! Facilis.';
        echo $render->renderizar(Helpers::formatarValor(150), alert_dark);
        echo $render->renderizar(Helpers::contaTempo('2020-06-05 13:30:00'), alert_primary);
        echo $render->renderizar(Helpers::resumeTexto($texto, 150), alert_success);
        echo "pagina contact";
    }
}

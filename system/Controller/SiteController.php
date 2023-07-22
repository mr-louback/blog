<?php

namespace system\Controller;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\RenderClass;
use system\Nucleus\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/site/views');
    }

    public function index(): void
    {
        $posts = (new PostModel())->lerTudo();

        $render = new RenderClass();
        $template= $this->template->rendering('index.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'formCad'=> "",
            'titulo' => 'Index',

            'posts'=> $posts,

        ]);
        echo $template;
    }
    public function formCad(): void
    {
        
        echo $this->template->rendering('formCad.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'titulo' => 'Cadastro',
        ]);
       
    }

    public function formLog(): void
    {

        echo $this->template->rendering('formLog.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'titulo' => 'Login',

        ]);
    }
    public function erro(): void
    {

        $render = new RenderClass();

        echo $render->renderizar($this->template->rendering('erro.html', [
            'titulo' => 'Página não encontrada.',

        ]), alert_danger);
        // echo ;
    }
}

<?php

namespace system\Controller;

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
        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('head.html', [
            Helpers::saudacao(),
            'success' => 'm-1 btn btn-outline-info'
        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('index.html', [
            'titulo' => 'index',
            'subtitulo' => 'subtitulo',
            'lorem' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellendus praesentium atque delectus quod, numquam id non magni fugiat velit ipsum doloremque blanditiis necessitatibus harum sed? Omnis ducimus sint quidem ipsum.'
        ]), alert_info);
        echo $render->renderizar($this->template->rendering('foot.html', []), alert_dark);
    }
    public function formCad(): void
    {
        
        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('head.html', [
            Helpers::saudacao(),
            'success' => 'm-1 btn btn-outline-success'
        ]), alert_dark);

        echo $render->renderizar($this->template->rendering('formCad.html', [
            'titulo' => 'Formulário de Cadastro',
            'Nome' => 'Nome',
            'Email' => 'Email',
            'Senha' => 'Senha',
            Helpers::validarEmail('email@email.com'),
            'success' => 'm-1 btn btn-outline-success'


        ]),alert_danger);
        echo $render->renderizar($this->template->rendering('foot.html', []), alert_dark);
    }

    public function formLog(): void
    {

        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('head.html', [
            Helpers::saudacao(),
            'success' => 'm-1 btn btn-outline-info'
        ]), alert_dark);

        echo $render->renderizar($this->template->rendering('formLog.html', [
            'titulo' => 'Formulário de Login',
            'Nome' => 'Nome',
            'Email' => 'Email',
            'Senha' => 'Senha',
            Helpers::validarEmail('email@email.com'),
            'success' => 'm-1 btn btn-outline-info'


        ]), alert_info);
        echo $render->renderizar($this->template->rendering('foot.html', []), alert_dark);
    }
}

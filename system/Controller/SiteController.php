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
        echo $render->renderizar($this->template->rendering('index.html', [
            'titulo' => 'index',
            'subtitulo' => 'subtitulo'
        ]), alert_success);
    }
    public function about(): void
    {
        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('about.html', [
            'titulo' => 'about',
            'subtitulo' => 'subtitulo',
        ]), alert_warning);
    }
    public function contact(): void
    {
        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('about.html', [
            'titulo' => 'contact',
            'subtitulo' => 'subtitulo',
        ]), alert_danger);
    }
    
}

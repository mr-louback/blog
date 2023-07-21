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
        echo $render->renderizar($this->template->rendering('header.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info'
        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('index.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'titulo' => 'index',
            'echo2' =>  Helpers::saudacao()
            
        ]), alert_warning);
        echo $render->renderizar($this->template->rendering('footer.html', [
            'success' => 'm-1 btn btn-outline-info',

        ]), alert_dark);
    }
    public function formCad(): void
    {
        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('header.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info'
        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('formCad.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'titulo' => 'Cadastro',
            'subtitulo'=>'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nesciunt repellat delectus at mollitia ex, officia similique nulla blanditiis itaque recusandae vero aspernatur labore quos ipsa est. Accusantium sequi fugiat quod.sdfgd fsgds fgsdf  g sd  fgggsdfg dgfsg  df gdsf g ds fg sd f gdsfgds fg dsfg ds f g dsf g dsfgdfgds fgds fg d fgdsfg dsf g dfg df  gdf gdf g df gsd g d fgdfsg dsf g df g dsfg  dfg ds g s'
        ]), alert_info);
        echo $render->renderizar($this->template->rendering('footer.html', [
            'success' => 'm-1 btn btn-outline-info',
        ]), alert_dark);
        return ;
    }

    public function formLog(): void
    {

        $render = new RenderClass();
        echo $render->renderizar($this->template->rendering('header.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info'
        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('formLog.html', [
            'success' => alert_info,
            'successButton' => 'm-1 btn btn-outline-info',
            'titulo' => 'Login',

        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('footer.html', [
            'success' => 'm-1 btn btn-outline-info',
        ]), alert_dark);
    }
    public function erro(): void
    {

        $render = new RenderClass();
        
        echo $render->renderizar($this->template->rendering('erro.html', [
            'titulo' => 'Página não encontrada.',

        ]), alert_danger);
        
    }
}

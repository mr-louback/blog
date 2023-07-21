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
            
        ]), alert_dark);
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

        ]), alert_dark);
        echo $render->renderizar($this->template->rendering('footer.html', [
            'success' => 'm-1 btn btn-outline-info',
        ]), alert_dark);
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
}

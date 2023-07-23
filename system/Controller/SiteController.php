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
        echo $this->template->rendering('index.html', [
            'success' => alert_warning,
            'successButton' => 'btn btn-outline-warning',
            
            'titulo' => 'Index',
            'subtitulo' => "lista de posts",
            'posts' => $posts,

        ]);;
    }
    public function post(int $id): void
    {
        $post = (new PostModel())->searchId($id);
        echo $this->template->rendering('post.html', [
            'post' => $post,
            'success' => alert_warning,
            'successButton' => 'btn btn-outline-info',
            'titulo' => 'Cadastro',
        ]);
    }
    public function formCad(): void
    {   echo $this->template->rendering('formCad.html', [
            'success' => alert_success,
            'successButton' => 'btn btn-outline-success',
            'titulo' => 'Cadastro',
        ]);
    }

    public function formLog(): void
    {

        echo $this->template->rendering('formLog.html', [
            'success' => alert_info,
            'successButton' => 'btn btn-outline-info',
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

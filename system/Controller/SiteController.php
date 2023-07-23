<?php

namespace system\Controller;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\RenderClass;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use Twig\Tests\ToStringStub;

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
            'navHeader' => alert_warning,
            'navHeaderButton' => 'btn btn-outline-warning',
            'alert_info' => alert_warning. ' btn ',
            'alert_light' => alert_light,
            'alert_primary' => alert_primary,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'resumeTexto'=> (new PostModel())->lerTudo(),
            'alert_success' => alert_success,
            'posts' => $posts,
            'categorias' => (new CategoryModel())->lerTudo(),
            'titulo' => 'Index',
            'subtitulo' => "lista de posts",

        ]);;
    }
    public function post(int $id): void
    {
        $post = (new PostModel())->searchId($id);
        if (!$post) {
            Helpers::redirect('erro');
        }
        echo $this->template->rendering('post.html', [
            'post' => $post,
            'alert_info' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_primary,

            'categorias' => $this->categorias(),
            'navHeader' => alert_warning,
            'navHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }
    public function erro(): void
    {
        echo $this->template->rendering('erro.html', [
            'titulo' => 'Página não encontrada.',
            'navHeader' => alert_warning,
            'navHeaderButton' => 'btn btn-outline-warning',
            'success'=> alert_danger
        ]);
    }
    public function categorias()
    {
        return (new CategoryModel())->lerTudo();
    }
    public function formCad(): void
    {
        echo $this->template->rendering('formCad.html', [
            'navHeader' => alert_warning,
            'navHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }

    public function formLog(): void
    {

        echo $this->template->rendering('formLog.html', [
            'navHeader' => alert_warning,
            'navHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Login',

        ]);
    }
   
}

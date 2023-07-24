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
      
        echo $this->template->rendering('index.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'alert_info' => alert_warning. ' btn ',
            'alert_warning' => alert_warning,
            'posts' => (new PostModel())->lerTudo(),
            'categorias' => (new CategoryModel())->lerTudoCategory(),
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
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }
    public function erro(): void
    {
        echo $this->template->rendering('erro.html', [
            'titulo' => 'Página não encontrada.',
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'success'=> alert_danger
        ]);
    }
    public function categorias()
    {
        return (new CategoryModel())->lerTudoCategory();
    }
    public function formCad(): void
    {
        echo $this->template->rendering('formCad.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }

    public function formLog(): void
    {

        echo $this->template->rendering('formLog.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Login',

        ]);
    }
    public function categoria(int $id): void
    {

        $post = (new CategoryModel())->searchIdCategory($id);
        // var_dump($post);
        echo $this->template->rendering('categoria.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'alert_info' => alert_warning. ' btn ',
            'alert_warning' => alert_warning,
            'posts' => $post,
            'categorias' => $this->categorias(),
           
            'titulo' => 'Index',
            'subtitulo' => "lista de posts",

        ]);;
    }
   
}

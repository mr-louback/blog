<?php

namespace system\Controller;

use system\Model\PostModel;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\Helpers;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/site/views');
    }

    public function index(): void
    {
        echo $this->template->rendering('index.html', [
            'posts' => (new PostModel())->search()->result(true),
            
        ]);;
    }
    // public function post(int $id): void
    // {
    //     $post = (new PostModel())->searchIdPost($id);
    //     if (!$post) {
    //         Helpers::redirect('erro');
    //     }
    //     echo $this->template->rendering('forms/post.html', [
    //         'post' => $post,
    //         'alert_info' => alert_primary,
    //         'alert_light' => alert_light,
    //         'alert_dark' => alert_primary,

    //         'categorias' => $this->categorias(),
    //         'cssNavHeader' => alert_warning,
    //         'cssNavHeaderButton' => 'btn btn-outline-warning',
    //         'titulo' => 'Cadastro',
    //     ]);
    // }
    public function erro(): void
    {
        echo $this->template->rendering('erro.html', [
            'titulo' => 'Página não encontrada.',
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'danger' => alert_danger
        ]);
    }
    public function categorias()
    {
        return (new CategoryModel())->readAllCategory();
    }
    public function formLog(): void
    {
        echo $this->template->rendering('formLog.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Login',

        ]);
    }
    public function formCad(): void
    {

        echo $this->template->rendering('formCad.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }
    public function formCadSent(): void
    {
        $busca = filter_input(INPUT_POST , 'busca', FILTER_DEFAULT);
        if (isset($busca)) {
            // $posts = (new PostModel())->readAllPosts();
            echo $this->template->rendering('formCadSent.html', [
                'cssNavHeader' => alert_warning,
                'cssNavHeaderButton' => 'btn btn-outline-warning',
                // 'posts' => $posts,
                'categorias' => $this->categorias(),
                'messageNotFound' => 'Dados não encontrados, tente outra palavra.',
            ]);;
            // var_dump($nome);
        }
    }
   
    public function categoria(int $id): void
    {

        $post = (new CategoryModel())->searchIdCategory($id);
        // var_dump($post);
        echo $this->template->rendering('categoria.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'alert_info' => alert_warning . ' btn ',
            'alert_warning' => alert_warning,
            'posts' => $post,
            'categorias' => $this->categorias(),
            'titulo' => 'Index',
            'subtitulo' => "lista de posts",

        ]);;
    }
}

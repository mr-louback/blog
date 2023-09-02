<?php

namespace system\Controller;

use DateTime;
use system\Model\CategoryModel;
use system\Model\PostModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/site/views');
    }
    public function index():void
    {
        echo $this->template->rendering('index.html', [
            'posts' => (new PostModel())->search(),
            'categorias' => (new CategoryModel())->search(),
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
            'btn_outline_dark' => 'btn btn-outline-dark',
            'btn_outline_success' => 'btn btn-outline-success',
        ]);;
    }
    public function post(string $slug): void
    {
        $posts = (new PostModel())->searchSlug($slug);
        $categorias = (new CategoryModel())->searchCategoryTitle($posts->categoria_id);
        if (!$posts) {
            Helpers::redirect('erro');
        }
        $posts->views += 1;
        (new PostModel())->updateCountView($posts->id, $posts->views);
        echo $this->template->rendering('forms/post.html', [
            'posts_titulo' => $posts->titulo,
            'posts_texto' => $posts->texto,
            'posts_thumb' => $posts->thumb,
            'categoria_titulo' => $categorias->titulo,
            'date' => (new DateTime(date($posts->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($posts->created_at)))->format('H:i'),
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function erro(): void
    {
        echo $this->template->rendering('error.html', [
            $this->message->messageDanger('Página não encontrada!')->flash(),
        ]);
    }
}

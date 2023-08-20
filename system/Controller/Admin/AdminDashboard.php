<?php

namespace system\Controller\Admin;

use DateTime;
use system\Controller\UserController;
use system\Model\CategoryModel;
use system\Model\PostModel;
use system\Model\UserModel;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class AdminDashboard extends AdminController
{
    public function dashboard(): void
    {
        $this->user = UserController::sessionIdUser();
        echo $this->template->rendering('dashboard.html', [
            // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_danger' => alert_danger,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'btn_outline_success' => 'btn btn-outline-success',
            'btn_outline_warning' => 'btn btn-outline-warning',
            // tabelas
            'categorias' => (new CategoryModel())->search(),
            'posts' => (new PostModel())->search(),
            'users' => (new UserModel())->search()


        ]);
    }
    public function post(int $id): void
    {
        $posts = (new PostModel())->search($id);
        $categorias = (new CategoryModel())->searchCategoryTitle($posts->categoria_id);
        if (!$posts) {
            Helpers::redirect('admin/erro');
        }
        echo $this->template->rendering('posts/post.html', [
            'posts' => $posts,
            'posts_titulo' => $posts->titulo,
            'posts_texto' => $posts->texto,
            'categoria_titulo' => $categorias->titulo,
            'date'=> (new DateTime(date($posts->created_at)))->format('d/m/Y'),
            'hour'=> (new DateTime(date($posts->created_at)))->format('H:i'),
            // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function category(int $id): void
    {
        $categorias = (new CategoryModel())->search($id);
        if (!$categorias) {
            Helpers::redirect('admin/erro');
        }
        echo $this->template->rendering('categories/category.html', [
            'categories_titulo' => $categorias->titulo,
            'categories_texto' => $categorias->texto,
            'date'=> (new DateTime(date($categorias->created_at)))->format('d/m/Y'),
            'hour'=> (new DateTime(date($categorias->created_at)))->format('H:i'),
            // // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }

    public function erro()
    {

        echo $this->template->rendering('error.html', [
            // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function logout(): void
    {
        $session = (new Session());
        $session->sessionClear('userId');
        Helpers::redirect('/');
    }
}

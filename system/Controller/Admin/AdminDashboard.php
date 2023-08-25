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
            'alert_success' => alert_success . ' px-4 py-3 ',
            'alert_danger' => alert_danger . ' px-4 py-3 ',
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'btn_outline_success' => 'btn btn-outline-success',
            'btn_outline_warning' => 'btn btn-outline-warning',
            // tabelas
            'posts' => (new PostModel())->search(),
            'postsCount' => (new PostModel())->countRegisters(),
            'postsCountAtivos' => (new PostModel())->countRegisters(1),
            'postsCountInativos' => (new PostModel())->countRegisters(0), 
            
            'users' => (new UserModel())->search(),
            'usersCount' => (new UserModel())->countRegisters(),
            'usersCountAtivos' => (new UserModel())->countRegisters(1),
            'usersCountInativos' => (new UserModel())->countRegisters(0),
            
            'categorias' => (new CategoryModel())->search(),
            'categoriesCount' => (new CategoryModel())->countRegisters(), 
            'categoriesCountAtivos' => (new CategoryModel())->countRegisters(1),
            'categoriesCountInativos' => (new CategoryModel())->countRegisters(0),



        ]);
    }
    public function post(string $slug): void
    {
        $posts = (new PostModel())->searchSlug($slug);
    //    var_dump($posts);
        $categorias = (new CategoryModel())->searchCategoryTitle($posts->categoria_id);
        if (!$posts) {
            Helpers::redirect('admin/erro');
        }
        echo $this->template->rendering('posts/post.html', [
            'posts' => $posts,
            'postsCounts' => $posts->countRegisters(),
            'posts_titulo' => $posts->titulo,
            'posts_texto' => $posts->texto,
            'categoria_titulo' => $categorias->titulo,
            'date' => (new DateTime(date($posts->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($posts->created_at)))->format('H:i'),
            // css
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'btn_outline_primary' => 'btn btn-outline-primary',
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
            'date' => (new DateTime(date($categorias->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($categorias->created_at)))->format('H:i'),
            // // css
            'alert_warning' => alert_warning,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'btn_outline_warning' => 'btn btn-outline-warning',
        ]);
    }
    public function user(int $id): void
    {
        $categorias = (new UserModel())->search($id);
        if (!$categorias) {
            Helpers::redirect('admin/erro');
        }
        echo $this->template->rendering('users/user.html', [
            'categories_titulo' => $categorias->nome,
            'categories_texto' => $categorias->email,
            'date' => (new DateTime(date($categorias->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($categorias->created_at)))->format('H:i'),
            // // css
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
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

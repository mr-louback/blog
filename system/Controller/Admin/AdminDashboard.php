<?php

namespace system\Controller\Admin;

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
            'categorias' => (new CategoryModel())->readAllCategory(),
            'posts' => (new PostModel())->readAllPosts(),
            'users' => (new UserModel())->searchAllUsers()


        ]);
    }
    public function post(int $id): void
    {
        $posts = (new PostModel())->searchIdPost($id);
        if (!$posts) {
            Helpers::redirect('erro');
        }
        echo $this->template->rendering('posts/post.html', [
            'posts_titulo' => $posts[0]->titulo,
            'posts_texto' => $posts[0]->texto,
            'posts_id' => $posts[0]->id,
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

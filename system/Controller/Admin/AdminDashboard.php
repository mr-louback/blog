<?php

namespace system\Controller\Admin;

use system\Controller\UserController;
use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class AdminDashboard extends AdminController
{
    public function dashboard(): void
    {
        $this->user = UserController::sessionIdUser();
        echo $this->template->rendering('dashboard.html', [

            $this->message->messageSuccess("Olá {$this->user->nome}, você está no dashboard!")->flash(),
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
    public function post(int $id): void
    {
        $posts = (new PostModel())->searchIdPost($id);
        // var_dump($posts[0]->id);
        if (!$posts) {
            Helpers::redirect('erro');
        }
        echo $this->template->rendering('forms/post.html', [
            'posts_titulo' => $posts[0]->titulo,
            'posts_texto' => $posts[0]->texto,
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
        Helpers::redirect('admin/login');
    }
}

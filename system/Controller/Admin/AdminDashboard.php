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
        ]);
    }
    public function post(int $id): void
    {
        $posts = (new PostModel())->searchIdPost($id);
        if (!$posts) {
            Helpers::redirect('erro');
        }
        echo $this->template->rendering('forms/post.html', [
            'posts' => $posts,
            // 'categorias' => $this->categorias(),
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'titulo' => 'Cadastro',
        ]);
    }
    public function logout():void
    {
        $session = (new Session());
        $session->sessionClear('userId');
        Helpers::redirect('admin/login');
    }
}

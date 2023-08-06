<?php

namespace system\Controller\Admin;

use system\Controller\UserController;
use system\Model\UserModel;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class AdminDashboard extends AdminController
{
    protected $user;
    public function dashboard(): void
    {
        $this->user = UserController::sessionIdUser();
        echo $this->template->rendering('dashboard.html', [
            'nome' => $this->user->nome,
            $this->message->messageSuccess("Olá {$this->user->nome}, você está no dashboard!")->flash(),
        ]);
    }
    public function logout():void
    {
        $session = (new Session());
        $session->sessionClear('userId');
        Helpers::redirect('admin/login');
    }
}

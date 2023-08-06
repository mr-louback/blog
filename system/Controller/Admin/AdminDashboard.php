<?php

namespace system\Controller\Admin;

use system\Controller\UserController;
use system\Model\UserModel;
use system\Nucleus\Session;

class AdminDashboard extends AdminController
{
    protected $user;
    public function dashboard(): void
    {
        $this->user = UserController::sessionIdUser();
        echo $this->template->rendering('dashboard.html', [
            $this->message->messageSuccess("{$this->user->nome} Sucesso")->flash(),
        ]);
    }
}

<?php

namespace system\Controller\Admin;

use system\Controller\UserController;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class AdminController extends Controller
{
    protected $user;
    public function __construct()
    {
        parent::__construct('layouts/dashboard/views');
        $this->user = UserController::sessionIdUser();
        // if ($this->user and $this->user->level == 3) {
        //     $this->message->messageWarning("{$this->user->nome}, você está em dashboard!")->flash();
        //     $user = (new Session())->sessionCheck('userId');
        //     var_dump($user);
        //     Helpers::redirect("/admin/dashboard");
        // }
        // if ($this->user and $this->user->level == 1) {
        //     $this->message->messageWarning("{$this->user->nome}, você está em Home!")->flash();
        //     (new Session())->sessionCheck('userId');
        //     Helpers::redirect("/");
        // }
        if(!$this->user or $this->user->level < 2){
            $this->message->messageWarning("{$this->user->nome}, você está em Home!")->flash();
            (new Session())->sessionClear('userId');
            Helpers::redirect("/");
        }
    }
}

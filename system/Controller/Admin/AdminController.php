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
        if(!$this->user){
            Helpers::redirect("/");
        }
        // você sabe
    }
}

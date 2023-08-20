<?php

namespace system\Controller;

use system\Model\UserModel;
use system\Nucleus\Helpers;
use system\Nucleus\Controller;
use system\Nucleus\Session;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/site/views');
    }

   public static function sessionIdUser(){
    $session = (new Session());
    if(!$session->sessionCheck('userId')){
        return null;
    }
    return (new UserModel())->search($session->userId);
   }
}

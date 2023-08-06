<?php

namespace system\Controller\Admin;

use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/dashboard/views');
    }
   
}

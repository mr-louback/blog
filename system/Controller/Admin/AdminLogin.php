<?php

namespace system\Controller\Admin;

use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;

class AdminLogin extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/dashboard/views');
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                $user = new UserModel();
                if (!$user->getUserByEmail($dados) or !$user->getUserByPassword($dados)) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } else {
                    
                    Helpers::redirect('/admin/dashboard');
                }
            }
        }
        echo $this->template->rendering('login.html', []);
    }
}

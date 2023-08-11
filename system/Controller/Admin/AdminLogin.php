<?php

namespace system\Controller\Admin;

use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

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
                $user = (new UserModel())->getUser($dados);
                if (!$user) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } elseif ($user->email !== $dados['email']) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } elseif ($user->senha !== $dados['senha']) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } else {
                   
                    (new UserModel())->updateLastLog($user->id);
                    (new Session())->sessionCreate('userId', $user->id);
                    if ($user->level == 1) {
                        Helpers::redirect('/admin/dashboard');
                    }
                    if ($user->level == 2) {
                        Helpers::redirect('/admin/posts/list');
                    }
                    if ($user->level == 3) {
                        Helpers::redirect('/admin/categories/list');
                    } 
                }
            }
        }
        echo $this->template->rendering('forms/login.html', [

            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    
}

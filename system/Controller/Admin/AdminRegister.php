<?php

namespace system\Controller\Admin;

use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class AdminRegister extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/dashboard/views');
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                $user = (new UserModel())->getUser($dados);
                if ($user) {
                    $this->message->messageDanger('Usuário existente!')->flash();
                    Helpers::redirect('admin/register');

                } else {
                    (new UserModel())->insertUser($dados);
                    $this->message->messageSuccess('Usuário cadastrado com sucesso!')->flash();
                    Helpers::redirect('admin/login');
                }
            }
        }
        echo $this->template->rendering('users/register.html', [

            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
}

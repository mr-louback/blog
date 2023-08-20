<?php

namespace system\Controller\Admin;

use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Nucleus\Helpers;
use system\Nucleus\RenderMessage;
use system\Nucleus\Session;

class AdminLogin extends Controller
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
                $user = (new UserModel())->searchUserEmail($dados);
                if ($user) {
                    $this->message->messageDanger('Usuário existente!')->flash();
                    Helpers::redirect('admin/register');
                } elseif (!Helpers::passwordValidated($dados['senha'])) {
                    (new RenderMessage())->messageDanger('Senha pracisa ter mais de 6(seis) caracteres!')->flash();
                } else {
                    (new UserModel())->insertLineModel($dados);
                    $this->message->messageSuccess('Usuário cadastrado com sucesso!')->flash();
                    Helpers::redirect('admin/login');
                }
            }
        }
        echo $this->template->rendering('forms/register.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                $user = (new UserModel())->searchUserEmail($dados);
                if (!$user) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } elseif ($user->email !== $dados['email']) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } elseif (!Helpers::passwordVerified($dados['senha'], $user->senha)) {
                    $this->message->messageWarning('Falha ao efetuar login!')->flash();
                } else {

                    (new UserModel())->updateLastLog($user->id);
                    (new Session())->sessionCreate('userId', $user->id);
                    if ($user->level == 1) {
                        Helpers::redirect('/admin/dashboard');
                    }
                    if ($user->level == 2) {
                        Helpers::redirect('/admin/dashboard');
                    }
                    if ($user->level == 3) {
                        Helpers::redirect('/admin/dashboard');
                    }
                }
            }
        }
        echo $this->template->rendering('forms/login.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
}

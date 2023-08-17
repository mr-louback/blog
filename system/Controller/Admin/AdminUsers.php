<?php

namespace system\Controller\Admin;

use PDOException;
use system\Nucleus\Helpers;
use system\Model\UserModel;
use system\Nucleus\RenderMessage;

class AdminUsers extends AdminController
{
    protected $user;

    public function list(): void
    {
        $users = (new UserModel())->getAllUsers();
        echo $this->template->rendering('users/list.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'users' => $users,
        ]);
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {

                    $user = (new UserModel())->getUserEmail($dados);
                    if ($user) {
                        $this->message->messageDanger('Usuário existente, tente outro e-mail!')->flash();
                        Helpers::redirect('admin/register');
                    } elseif (!Helpers::validatePassword($dados['senha'])) {
                        (new RenderMessage())->messageDanger('Senha pracisa ter mais de 6(seis) a 20 caracteres!')->flash();
                    } else {
                        (new UserModel())->insertUser($dados);
                        $this->message->messageSuccess('Usuário cadastrado com sucesso!')->flash();
                        Helpers::redirect('admin/users/list');
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
    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                try {
                    $user = (new UserModel())->getUserEmail($dados);
                    if ($user and Helpers::validatePassword($dados['senha'])) {
                        (new UserModel())->updateUser($dados);
                        $this->message->messageInfo(" Usuário editado com sucesso!")->flash();
                        Helpers::redirect('admin/users/list');
                    } elseif (!Helpers::validatePassword($dados['senha'])) {
                        (new RenderMessage())->messageDanger('Senha pracisa ter mais de 6(seis) a 20 caracteres!')->flash();
                    } else {
                        if (!Helpers::validatePassword($dados['senha'])) {
                            (new RenderMessage())->messageDanger('Senha prdsgdsacisa ter mais de 6(seis) a 20 caracteres!')->flash();
                        }
                        (new UserModel())->updateUser($dados);
                        $this->message->messageInfo(" Usuáridfsghdsgfho editado com sucesso!")->flash();
                        Helpers::redirect('admin/users/list');
                    }
                } catch (PDOException $err) {
                    if ($err->getCode() == '23000' and $err->errorInfo[1] == 1062) {
                        $this->message->messageDanger("Usuário existente, tente outro e-mail!")->flash();
                    }
                }
            }
        }
        echo $this->template->rendering('users/edit.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',

            'user' => (new UserModel())->getUserId($id),
        ]);
    }
    public function  delete(int $id): void
    {
        (new UserModel())->deleteUserId($id);
        $this->message->messageWarning('Usuário deletado com sucesso!')->flash();
        Helpers::redirect('admin/users/list');
    }
}

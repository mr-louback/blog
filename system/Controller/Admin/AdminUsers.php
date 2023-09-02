<?php

namespace system\Controller\Admin;

use DateTime;
use PDOException;
use system\Nucleus\Helpers;
use system\Model\UserModel;
use system\Nucleus\RenderMessage;

class AdminUsers extends AdminController
{
    protected $user;
    public function list(): void
    {
        $users = (new UserModel())->search();
        echo $this->template->rendering('users/list.html', [
            'alert_primary' => alert_primary,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'users' => $users,
        ]);
    }
    public function user(int $id): void
    {
        $user = (new UserModel())->search($id);
        if (!$user) {
            Helpers::redirect('admin/erro');
        }
        echo $this->template->rendering('users/user.html', [
            'categories_titulo' => $user->nome,
            'categories_texto' => $user->email,
            'date' => (new DateTime(date($user->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($user->created_at)))->format('H:i'),
            // // css
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
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
                    $this->message->messageDanger('Usuário existente, tente outro e-mail!')->flash();
                    Helpers::redirect('admin/register');
                } elseif (!Helpers::passwordValidated($dados['senha'])) {
                    (new RenderMessage())->messageDanger('Senha pracisa ter mais de 6(seis) a 20 caracteres!')->flash();
                } else {
                    (new UserModel())->insertLineUser($dados);
                    $this->message->messageSuccess('Usuário cadastrado com sucesso!')->flash();
                    Helpers::redirect('admin/users/list');
                }
            }
        }
        echo $this->template->rendering('forms/register.html', [
            'btn_outline_info' => 'btn btn-outline-info',
            'alert_primary' => alert_primary,
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
                    $user = (new UserModel())->search($id);
                    if ($user->email and Helpers::passwordValidated($dados['senha'])) {
                        (new UserModel())->updateLineUser($id, $dados);
                        $this->message->messageSuccess(" Usuário editado com sucesso!")->flash();
                        Helpers::redirect('admin/users/list');
                    } elseif (!Helpers::passwordValidated($dados['senha'])) {
                        (new RenderMessage())->messageDanger('Senha pracisa ter mais de 6(seis) a 20 caracteres!')->flash();
                    } else {
                        if (!Helpers::passwordValidated($dados['senha'])) {
                            (new RenderMessage())->messageDanger('Senha precisa ter mais de 6(seis) a 20 caracteres!')->flash();
                        }
                        (new UserModel())->updateLineUser($id, $dados);
                        $this->message->messageSuccess(" Usuário editado com sucesso!")->flash();
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
            'btn_outline_info' => 'btn btn-outline-info',
            'user' => (new UserModel())->search($id),
            'alert_primary' => alert_primary,
        ]);
    }
    public function  delete(int $id): void
    {
        (new UserModel())->deleteLineModel($id);
        $this->message->messageSuccess('Usuário deletado com sucesso!')->flash();
        Helpers::redirect('admin/users/list');
    }
}

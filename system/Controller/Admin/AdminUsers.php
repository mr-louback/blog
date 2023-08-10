<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Model\CategoryModel;
use system\Model\UserModel;
use system\Nucleus\RenderClass;

class AdminUsers extends AdminController
{
    protected $user;

    public function list(): void
    {
        $posts = (new UserModel())->getAllUsers();
        echo $this->template->rendering('users/list.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',

            'posts' => $posts,
        ]);
    }
    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } elseif ($dados['email'] == (new UserModel())->getUser($dados)->email) {
                $this->message->messageDanger('Usuário existente!')->flash();
                Helpers::redirect('admin/users/register');
            } else {
                (new UserModel())->insertUser($dados);
                $this->message->messageSuccess('Usuário cadastrado com sucesso!')->flash();
                Helpers::redirect('admin/login');
            }
        }


        echo $this->template->rendering('users/register.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',

            // 'categorias' => (new CategoryModel())->readAllCategory(),
            // 'postsId' => (new PostModel())->readAllPosts(),
        ]);
    }
    public function edit(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new UserModel())->updateUser($dados);
            $this->message->messageInfo('Usuário editado com sucesso!')->flash();
            Helpers::redirect('admin/users/list');
        }
        $user = (new UserModel())->getUserId($id);
        echo $this->template->rendering('users/edit.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',

            'user' => $user,
        ]);
    }
    public function  delete(int $id): void
    {
        (new UserModel())->deleteLineUser($id);
        $this->message->messageWarning('Usuário deletado com sucesso!')->flash();
        Helpers::redirect('admin/users/list');
    }
}

<?php

namespace system\Controller;

use system\Model\PostModel;
use system\Model\UserModel;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\Helpers;
use system\Nucleus\Session;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct('layouts/site/views');
    }

    public function index(): void
    {
        echo $this->template->rendering('index.html', [
            'posts' => (new PostModel())->search()->result(true),

            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);;
    }

    public function post(int $id): void
    {
        $posts = (new PostModel())->searchIdPost($id);
        if (!$posts) {
            Helpers::redirect('erro');
        }
        echo $this->template->rendering('forms/post.html', [
            'posts_titulo' => $posts[0]->titulo,
            'posts_texto' => $posts[0]->texto,

            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',


            'titulo' => 'Cadastro',
        ]);
    }


    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userEmail = (new UserModel())->getUserEmail($dados);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } elseif ($dados['email'] == $userEmail) {
                $this->message->messageDanger('Usuário existente!')->flash();
                // Helpers::redirect('/forms/register');
            } else {
                (new UserModel())->insertUser($dados);
                $this->message->messageSuccess('Todos os dados foram salvos com sucesso!')->flash();
                Helpers::redirect('admin/login');
            }
        }

        echo $this->template->rendering('forms/register.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function erro(): void
    {
        echo $this->template->rendering('error.html', [
            'titulo' => 'Página não encontrada.',

            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
}

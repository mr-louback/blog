<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Model\CategoryModel;

class AdminPosts extends AdminController
{
    public function list(): void
    {
        $posts = (new PostModel());
        echo $this->template->rendering('posts/list.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'posts' => $posts->readAllPosts(),
            'categorias' => (new CategoryModel())->readAllCategory(),
        ]);
    }
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                (new PostModel())->insertLinePosts($dados);
                $this->message->messageInfo('Postagem criada com sucesso!')->flash();
                Helpers::redirect('admin/posts/list');
            }
        }
        echo $this->template->rendering('posts/register.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
            'categorias' => (new CategoryModel())->readAllCategory(),
        ]);
    }
    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                (new PostModel())->updateLinePosts($dados);
                $this->message->messageInfo('Post editado com sucesso!')->flash();
                Helpers::redirect('admin/posts/list');
            }
        }
        echo $this->template->rendering('posts/edit.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
            'posts' => (new PostModel())->searchIdPost($id),
            'categorias' => (new CategoryModel())->readAllCategory(),
        ]);
    }
    public function  delete(int $id): void
    {
        (new PostModel())->deleteLinePosts($id);
        $this->message->messageInfo('Post deletado com sucesso!')->flash();
        Helpers::redirect('admin/posts/list');
    }
    public function erro(){
        
        echo $this->template->rendering('error.html', [
            $this->message->messageDanger('Postagem não encontrada!')->flash(),
            
            // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
}

<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Model\CategoryModel;
use system\Nucleus\RenderClass;

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
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',

            'posts' => $posts->search()->order('status asc, id asc')->result(true),
        ]);
    }
    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                (new PostModel())->insertLinePosts($dados);

                $this->message->messageSuccess('Postagem feita com sucesso!')->flash();
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

            'postsId' => (new PostModel())->readAllPosts(),
        ]);
    }
    public function edit(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModel())->updateLinePosts($dados);
            $this->message->messageInfo('Post editado com sucesso!')->flash();
            Helpers::redirect('admin/posts/list');
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
        $this->message->messageWarning('Post deletado com sucesso!')->flash();
        Helpers::redirect('admin/posts/list');
    }
}

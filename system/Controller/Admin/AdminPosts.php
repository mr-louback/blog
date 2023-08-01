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
        echo $this->template->rendering('posts/list.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'posts' => (new PostModel())->readAllPosts(),
        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModel())->insertLinePosts($dados);
           $this->message->messageSuccess('Post cadastrado com sucesso!')->flash();
            Helpers::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/cadastrar.html', []);
    }
    public function editar(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModel())->updateLinePosts($dados);
           $this->message->messageInfo('Post editado com sucesso!')->flash();

            Helpers::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/editar.html', [
            'posts' => (new PostModel())->searchIdPost($id),
            'categorias' => (new CategoryModel())->searchIdCategory($id),
            'alerts' => alert_warning,
        ]);
    }
    public function  deletar(int $id): void
    {
        (new PostModel())->deleteLinePosts($id);
        $this->message->messageWarning('Post deletado com sucesso!')->flash();

        Helpers::redirect('admin/posts/list');
    }
}

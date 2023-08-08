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
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'posts' => $posts->search()->order('status asc, id asc')->result(true),
        ]);
    }
    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModel())->insertLinePosts($dados);
            $this->message->messageSuccess('Post cadastrado com sucesso!')->flash();
            Helpers::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/register.html', [
            'categorias' => (new CategoryModel())->readAllCategory(),
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
            'posts' => (new PostModel())->searchIdPost($id),
            'categorias' => (new CategoryModel())->searchIdCategory($id),
        ]);
    }
    public function  delete(int $id): void
    {
        (new PostModel())->deleteLinePosts($id);
        $this->message->messageWarning('Post deletado com sucesso!')->flash();
        Helpers::redirect('admin/posts/list');
    }
}

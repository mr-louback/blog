<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Model\CategoryModel;

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
            Helpers::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/cadastrar.html', [
            'posts' => (new PostModel())->readAllPosts(),

        ]);       
       
    }
    public function editar(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            Helpers::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/cadastrar.html', [
            'posts' => (new PostModel())->searchIdPost($id),
        ]);
    }
}

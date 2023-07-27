<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\RenderClass;

class AdminPosts extends AdminController
{

    public function list(): void
    {

        echo $this->template->rendering('posts/postsList.html', [
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
        echo $this->template->rendering('posts/postsCadastrar.html', [

            'categorias' => (new CategoryModel())->readAllCategory(),

        ]);
    }
    public function editar(int $id): void
    {
        $post = (new PostModel())->searchIdPost($id);
        echo $this->template->rendering('posts/postEditar.html', [
            'posts' => $post,
            'categorias' => (new CategoryModel())->readAllCategory(),

        ]);
    }
}

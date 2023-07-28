<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\RenderClass;
use system\Support\Template;

class AdminCategorias extends AdminController
{

    public function list(): void
    {

        echo $this->template->rendering('categorias/list.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'CategoryModel' => (new CategoryModel())->readAllCategory(),
        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoryModel())->insertLineCategory($dados);
            Helpers::redirect('admin/categorias/list');
        }
        echo $this->template->rendering('categorias/cadastrar.html', [
            'categorias' => (new CategoryModel())->readAllCategory(),
            'posts' => (new PostModel())->readAllPosts(),
        ]);
    }
    public function editar(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoryModel())->updateLineCategory($dados);
            Helpers::redirect('admin/categorias/list');
        }
        echo $this->template->rendering('categorias/editar.html', [
            'posts' => (new CategoryModel())->searchIdCategory($id),
            'categorias' => (new CategoryModel())->readAllCategory(),
        ]);
    }
}

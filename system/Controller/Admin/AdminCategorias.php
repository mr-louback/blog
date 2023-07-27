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
        echo $this->template->rendering('categorias/cadastrar.html', []);
    }
    public function editar(int $id): void
    {
        $post = (new CategoryModel())->searchIdCategory($id);
        echo $this->template->rendering('categorias/editar.html', [
            'posts' => $post,
            'categorias' => (new CategoryModel())->readAllCategory(),

        ]);
    }
}

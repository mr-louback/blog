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
            'categorias' => (new CategoryModel())->readAllCategory(),
        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoryModel())->insertLineCategory($dados);
            $this->message->messageSuccess('Categoria cadastrada com sucesso!')->flash();
            Helpers::redirect('admin/categorias/list');
        }
        echo $this->template->rendering('categorias/cadastrar.html', []);
    }
    public function editar(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoryModel())->updateLineCategory($dados);
            $this->message->messageInfo('Categoria editada com sucesso!')->flash();
            Helpers::redirect('admin/categorias/list');
        }
        echo $this->template->rendering('categorias/editar.html', [
            'categorias' => (new CategoryModel())->searchIdCategory($id),
        ]);
    }
    public function  deletar(int $id): void
    {
        (new CategoryModel())->deleteLinePosts($id);
        $this->message->messageWarning('Categoria deletada com sucesso!')->flash();
        Helpers::redirect('admin/categorias/list');
    }
}

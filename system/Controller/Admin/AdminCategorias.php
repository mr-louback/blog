<?php

namespace system\Controller\Admin;

use system\Nucleus\Helpers;
use system\Model\CategoryModel;
use system\Model\PostModel;

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
        echo $this->template->rendering('categorias/cadastrar.html', [
            'categorias' => (new CategoryModel())->readAllCategory(),
            'posts' => (new PostModel())->search(),

        ]);
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
    public function deletar(int $id): void
    {
        (new CategoryModel())->deleteLineCategory($id);
        $this->message->messageWarning('Categoria deletada com sucesso!')->flash();
        Helpers::redirect('admin/categorias/list');
    }
}

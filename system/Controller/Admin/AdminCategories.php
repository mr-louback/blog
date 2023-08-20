<?php

namespace system\Controller\Admin;

use PDOException;
use system\Nucleus\Helpers;
use system\Model\CategoryModel;
use system\Model\PostModel;

class AdminCategories extends AdminController
{

    public function list(): void
    {
        echo $this->template->rendering('categories/list.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'categorias' => (new CategoryModel())->search(),
        ]);
    }
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                (new CategoryModel())->insertLineModel($dados);
                $this->message->messageSuccess('Categoria criada com sucesso!')->flash();
                Helpers::redirect('admin/categories/list');
            }
        }

        echo $this->template->rendering('categories/register.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } else {
                (new CategoryModel())->updateLineModel($id, $dados);
                $this->message->messageSuccess('Categoria editada com sucesso!')->flash();
                Helpers::redirect('admin/categories/list');
            }
        }
        echo $this->template->rendering('categories/edit.html', [
            'categorias' => (new CategoryModel())->search($id),
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
    public function deletar(int $id): void
    {
        try {
            (new CategoryModel())->deleteLineModel($id);
            $this->message->messageSuccess('Categoria deletada com sucesso!')->flash();
            Helpers::redirect('admin/categories/list');
        } catch (PDOException $err) {
            if ($err->getCode() == '23000' and $err->errorInfo[1] == 1451) {
                $this->message->messageWarning("Existem postagens vinculadas a essa categoria!")->flash();
                Helpers::redirect('admin/categories/list');
            }
        }
    }
}

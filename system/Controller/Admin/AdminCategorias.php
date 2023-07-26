<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\RenderClass;

class AdminCategorias extends AdminController
{

    public function list(): void
    {

        echo $this->template->rendering('categorias/list.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'CategoryModel' => (new CategoryModel())->lerTudoCategory(),
        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($dados) && $dados !== "") {
            // echo $data;
            $texto = $dados['titulo'];
            $textarea = $dados['floatingTextarea'];
            $status = $dados['select'];
            // var_dump($texto, $textarea, $status);

            echo (new RenderClass())->renderizar((new CategoryModel())->insertLineCategory($texto, $textarea, $status), alert_success);

            echo $this->template->rendering('categorias/cadastrar.html', [
                'cssNavHeader' => alert_warning,
                'cssNavHeaderButton' => 'btn btn-outline-warning',


            ]);
        } else {
            echo (new RenderClass())->renderizar('falha ao gravar dados!', alert_danger);
            echo $this->template->rendering('categorias/cadastrar.html', [
                'cssNavHeader' => alert_warning,
                'cssNavHeaderButton' => 'btn btn-outline-warning',
            ]);
        };
    }
}

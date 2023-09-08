<?php

namespace system\Controller\Admin;

use DateTime;
use system\Model\PostModel;
use system\Model\UserModel;
use system\Nucleus\Helpers as HelpNucleus;
use system\Model\CategoryModel;
use system\Nucleus\Helpers;

class AdminPosts extends AdminController
{
    public function list(): void
    {
        echo $this->template->rendering('posts/list.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_danger' => 'btn btn-outline-danger',
            'btn_outline_info' => 'btn btn-outline-info',
            'posts' => (new PostModel())->limitPosts(25),
            'categorias' => (new CategoryModel())->search(),
        ]);
    }
    public function register(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados['slug'] = Helpers::criarSlug($dados['titulo']) . '-' . uniqid();
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } elseif (!empty($_FILES['thumb']['size'])  == 0) {
                $dados;
                $handle = new \Verot\Upload\Upload($_FILES['thumb']);
                $handle->file_new_name_body   = $_FILES['thumb']['name'];
                $handle->image_resize         = true;
                $handle->image_x              = 825;
                $handle->image_y              = 500;
                $handle->process('uploads/images/');
                $handle->image_resize         = true;
                $handle->image_x              = 200;
                $handle->file_new_name_body   = $_FILES['thumb']['name'];
                $handle->image_ratio_y        = true;
                $handle->process('uploads/images/thumbs/');
            }
            $dados['thumb'] = $_FILES['thumb']['name'];
            (new PostModel())->insertLineModel($dados);
            $this->message->messageSuccess('Postagem criada com sucesso!')->flash();
            HelpNucleus::redirect('admin/posts/list');
        }
        echo $this->template->rendering('posts/register.html', [
            'alert_primary' => alert_primary,
            'btn_outline_info' => 'btn btn-outline-info',
            'categorias' => (new CategoryModel())->search(),
        ]);
    }
    public function edit(int $id): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados['thumb'] = Helpers::criarSlug($dados['titulo']) . '-' . uniqid();
            $dados['slug'] = Helpers::criarSlug($dados['titulo']) . '-' . uniqid();
            if (in_array('', $dados)) {
                $this->message->messageWarning('Todos os campos são obrigatórios!')->flash();
            } elseif (!empty($_FILES['thumb']['size'])) {
                $handle = new \Verot\Upload\Upload($_FILES['thumb']);
                $handle->file_new_name_body   = pathinfo($_FILES['thumb']['name'], PATHINFO_FILENAME);
                $handle->image_resize         = true;
                $handle->image_x              = 825;
                $handle->image_y              = 500;
                $handle->process('uploads/images/');
                $handle->image_resize         = true;
                $handle->image_x              = 200;
                $handle->file_new_name_body   = pathinfo($_FILES['thumb']['name'], PATHINFO_FILENAME);
                $handle->image_ratio_y        = true;
                $handle->process('uploads/images/thumbs/');
            }
            $dados['thumb'] = $_FILES['thumb']['name'];

            (new PostModel())->updateLineModel($dados['id'], $dados);
            $this->message->messageSuccess('Postagem criada com sucesso!')->flash();
            HelpNucleus::redirect('admin/posts/list');
            (new PostModel())->updateLineModel($dados['id'], $dados);
            $this->message->messageSuccess('Postagem criada com sucesso!')->flash();
            HelpNucleus::redirect('admin/posts/list');
        }
        $posts = (new PostModel())->search($id);
        $categorias = (new CategoryModel())->searchCategoryTitle($posts->categoria_id);
        echo $this->template->rendering('posts/edit.html', [
            'alert_info' => alert_info,
            'alert_primary' => alert_primary,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
            'posts_id' => $posts->id,
            'user_name' => $posts->user_id,
            'posts_titulo' => $posts->titulo,
            'posts_texto' => $posts->texto,
            'posts_categoria_id' => $posts->categoria_id,
            'categoria_titulo' => ($categorias->titulo) ?? '',
            'posts_status' => $posts->status,
            'posts_created_at' => $posts->created_at,
            'categorias' => (new CategoryModel())->search(),
            'date' => (new DateTime(date($posts->created_at)))->format('d/m/Y'),
            'hour' => (new DateTime(date($posts->created_at)))->format('H:i'),
        ]);
    }
    public function  delete(int $id): void
    {
        (new PostModel())->deleteLineModel($id);
        $this->message->messageSuccess('Post deletado com sucesso!')->flash();
        HelpNucleus::redirect('admin/posts/list');
    }
    public function erro()
    {

        echo $this->template->rendering('error.html', [
            $this->message->messageDanger('Postagem não encontrada!')->flash(),

            // css
            'alert_primary' => alert_primary,
            'alert_info' => alert_info,
            'alert_light' => alert_light,
            'alert_dark' => alert_dark,
            'alert_warning' => alert_warning,
            'btn_outline_warning' => 'btn btn-outline-warning',
            'btn_outline_info' => 'btn btn-outline-info',
        ]);
    }
}

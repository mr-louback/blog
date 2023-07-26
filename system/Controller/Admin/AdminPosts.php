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

        echo $this->template->rendering('posts/list.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            'posts'=> (new PostModel())->lerTudo(),            
        ]);
    }
}

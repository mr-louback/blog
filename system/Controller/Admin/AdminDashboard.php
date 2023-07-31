<?php

namespace system\Controller\Admin;

use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\Controller;
use system\Model\CategoryModel;
use system\Nucleus\RenderClass;

class AdminDashboard extends AdminController
{
    
    public function dashboard(): void
    {
        echo $this->template->rendering('dashboard.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',            
        ]);
    }
}

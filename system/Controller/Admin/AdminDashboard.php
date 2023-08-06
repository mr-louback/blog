<?php

namespace system\Controller\Admin;


class AdminDashboard extends AdminController
{
    public function dashboard(): void
    {
        echo $this->template->rendering('dashboard.html', [
            'cssNavHeader' => alert_warning,
            'cssNavHeaderButton' => 'btn btn-outline-warning',
            $this->message->messageSuccess("Sucesso")->flash(),
        ]);
    }
}

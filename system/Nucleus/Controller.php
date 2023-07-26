<?php
namespace system\Nucleus;
use system\Support\Template;
class Controller
{
    protected Template $template;
    public function __construct($directory)
    {
        $this->template = new Template($directory);       
    }
    
}

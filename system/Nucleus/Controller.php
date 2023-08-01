<?php
namespace system\Nucleus;
use system\Support\Template;
class Controller
{
    protected Template $template;
    protected RenderMessage $message;
    public function __construct($directory)
    {
        $this->template = new Template($directory);    
        $this->message = new RenderMessage();   
    }
    
}

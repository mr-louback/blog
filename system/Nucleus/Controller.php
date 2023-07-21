<?php
namespace system\Nucleus;
use system\Support\Template;
use system\Nucleus\Connection;
class Controller
{
    protected Template $template;
    // protected Connection $conn;
    public function __construct($directory)
    {
        $this->template = new Template($directory);       
        // $this->conn = new Connection();       
    }
    
}

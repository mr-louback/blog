<?php

namespace system\Support;

use system\Controller\UserController;
use system\Model\PostModel;
use system\Nucleus\Helpers;
use system\Nucleus\RenderClass;
use Twig\Environment;
use Twig\Lexer;
use Twig\Loader\FilesystemLoader;
use \Twig\TwigFunction;

class Template
{
    private $twig;
    public function __construct(string $directory)
    {
        $loader = new FilesystemLoader($directory);
        $this->twig =  new Environment($loader);
        $lexer = new Lexer($this->twig, array(
            $this->helpers()
        ));
        $this->twig->setLexer($lexer);
    }
    private function helpers(): void
    {
        array(
            $this->twig->addFunction(
                new TwigFunction('url', function (string $texto) {
                    return Helpers::url($texto);
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('saudacao', function () {
                    return Helpers::saudacao();
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('contaTempo', function (string $texto) {
                    return Helpers::contaTempo($texto);
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('resumeTexto',function (string $texto, int $number){
                    return Helpers::resumeTexto($texto, $number);
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('flash',function (){
                    return Helpers::flash();
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('user',function (){
                    return UserController::sessionIdUser();
                })
            ),
            
        );
    }
    public function rendering(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }
}

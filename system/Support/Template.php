<?php

namespace system\Support;

use system\Nucleus\Helpers;
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
                new TwigFunction('urlIndex', function () {
                    return Helpers::url('');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlFormCad', function () {
                    return Helpers::url('formCad');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlFormLog', function () {
                    return Helpers::url('formLog');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlSidebar', function () {
                    return Helpers::url('../../../layouts/site/views/sidebar.html');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlCssSite', function () {
                    return Helpers::url('../../../layouts/site/assets/css/site.css');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlCss', function () {
                    return Helpers::url('../../../layouts/assets/css/style.css');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlJsSite', function () {
                    return Helpers::url('../../../layouts/site/assets/js/site.js');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlJs', function () {
                    return Helpers::url('../../../layouts/assets/js/script.js');
                })
            ),
            
            
            $this->twig->addFunction(
                new TwigFunction('urlLogin', function () {
                    return Helpers::url('formLog');
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('urlHome', function (string $texto) {
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
            )
            
            
        );
    }
    public function rendering(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }
}

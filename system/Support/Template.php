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
                new TwigFunction('urlRegister', function () {
                    return Helpers::url('formCad');
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
                new TwigFunction('resumeTexto', function (string $texto, int $limite) {
                    return Helpers::resumeTexto($texto, $limite);
                })
            ),
            $this->twig->addFunction(
                new TwigFunction('contaTempo', function (string $texto) {
                    return Helpers::contaTempo($texto);
                })
            )
            
            
        );
    }
    public function rendering(string $view, array $dados)
    {
        return $this->twig->render($view, $dados);
    }
}

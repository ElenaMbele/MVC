<?php
class Render
{
    private $templateDirectory;
    private $twig;
    public function __construct()
    {
        $this->templateDirectory = realpath(__DIR__.'/../Views');
    }

    public function render($template, $data = [])
    {
        $path = $this->templateDirectory.'/'.$template.'.php';
        if(!file_exists($path)) {
            throw RuntimeException();
        }
        extract($data);
        include $path;
    }

    public function renderJSON($template, $data = [])
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function renderTwig($template, $data = [])
    {
//       if (!$this->twig) {
////            $loader = new Twig_Loader_Filesystem($this->templateDirectory);
////            $this->twig = new Twig_Environment($loader);
//
//            $loader = new \Twig\Loader\FilesystemLoader($this->templateDirectory);
//            $this->twig = new \Twig\Environment($loader, []);
//
////            return $twig->render($template, $data);
//        }
//
//        return $this->twig->render($template, $data);
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../Views');
        $twig = new \Twig\Environment($loader, []);

        return $twig->render($template, $data);
    }
}
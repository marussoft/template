<?php 

declare(strict_types=1);

namespace Marussia\Template;

class Template
{
    private $twig;
    
    private $variables = [];

    public function __construct(string $pathToViews)
    {
        $loader = new \Twig\Loader\FilesystemLoader($pathToViews);
        $this->twig = new \Twig\Environment($loader);
    }

    public function content(array $variables)
    {
        $this->variables = array_merge($this->variables, $variables);
    }
    
    public function render(string $template)
    {
        return $this->twig->render($template . '.twig', $this->variables);
    }
}

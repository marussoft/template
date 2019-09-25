<?php 

declare(strict_types=1);

namespace Marussia\Template;

class Template
{
    private $twig;
    
    private $variables = [];

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(Config::get('kernel.template', 'path_to_view'));
        $this->twig = new \Twig\Environment($this->loader);
    }

    public function content(array $variables) : self
    {
        $this->variables = array_merge($this->variables, $variables);
        return $this;
    }
    
    public function render(string $template) : string
    {
        return $this->twig->render($template . '.twig', $this->variables);
    }
    
    public function exists(string $template) : bool
    {
        return $this->loader->exists($template . '.twig');
    }
}

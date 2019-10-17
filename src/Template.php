<?php

declare(strict_types=1);

namespace Marussia\Template;

use Marussia\Config\Config;

class Template
{
    private $twig;

    private $variables = [];

    public function __construct(Config $config)
    {
        $this->loader = new \Twig\Loader\FilesystemLoader($config->get('kernel.template', 'path_to_view'));
        $this->twig = new \Twig\Environment($this->loader);

        $extensions = $config->get('kernel.template', 'extensions');

        if (!empty($extensions)) {
            foreach ($extensions as $extension) {
                $this->twig->addExtension(new $extension);
            }
        }
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

<?php 

declare(strict_types=1);

namespace Marussia\Template;

class Template
{

    private $template;
    
    private $templatesDir;

    public function __construct(string $dirPath, string $template = 'main')
    {
        $this->template = $template;
        $this->templatesDir = $dirPath;
    }

    public function render()
    {
        ob_start();

        require_once($this->templatesDir . $this->template . '.tpl.php');

        return ob_get_contents();
    }
}

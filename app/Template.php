<?php

namespace Otomaties\Jobs;

class Template
{

    private $basePath;
    private $templateName;
    private $variables = [];

    public function __construct(string $templateName, array $variables = [])
    {
        $this->basePath = dirname(__FILE__, 2) . '/templates/';
        $this->templateName = rtrim(ltrim($templateName, '/'), '.php');
        $this->variables = $variables;
    }

    public function get()
    {
        ob_start();
        $this->render();
        return ob_get_clean();
    }

    public function render()
    {
        extract($this->variables);
        include $this->basePath . $this->templateName . '.php';
    }
}

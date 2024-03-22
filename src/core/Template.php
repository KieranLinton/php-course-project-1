<?php

class Template
{

    private $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }
    public function view(string $template, $variables = [])
    {
        extract($variables);

        include VIEW_PATH . "$this->layout.html";
    }
}

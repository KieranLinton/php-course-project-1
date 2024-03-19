<?php

class Template
{
    public function view(string $template, $variables = [])
    {
        extract($variables);

        include VIEW_PATH . 'layout/default.html';
    }
}

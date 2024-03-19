<?php

class Template
{
    public function view($template, $variables = [])
    {
        extract($variables);

        include VIEW_PATH . 'layout/default.html';
    }
}

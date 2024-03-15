<?php

class Template{
    public function view($template, $variables = []) {
        extract($variables);

        include 'views/layout/default.html';
    }
}
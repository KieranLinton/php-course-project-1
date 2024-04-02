<?php

namespace modules\page\models;

use core\db\AbstractEntity;

// #[\AllowDynamicProperties]
class Page extends AbstractEntity
{
    public string $title;
    public string $content;

    public function __construct($dbc)
    {
        parent::__construct($dbc, 'pages');
    }

    protected function initFields()
    {
        $this->fields = [
            'title',
            'content'
        ];
    }
}

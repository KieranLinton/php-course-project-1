<?php

// #[\AllowDynamicProperties]
class Page extends AbstractEntity
{
    public int $id;
    public string $title;
    public string $content;

    public function __construct($dbc)
    {
        parent::__construct($dbc, 'pages');
    }

    protected function initFields()
    {
        $this->fields = [
            'id',
            'title',
            'content'
        ];
    }
}

<?php


class Page extends AbstractEntity
{
    public function __construct(PDO $dbc)
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

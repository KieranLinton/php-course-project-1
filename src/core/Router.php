<?php

class Router extends AbstractEntity
{
    public int $id;
    public string $module;
    public string $action;
    public int $entity_id;
    public string $url;

    public function __construct(PDO $dbc)
    {
        parent::__construct($dbc, 'routes');
    }

    protected function initFields()
    {
        $this->fields = [
            'id',
            'module',
            'action',
            'entity_id',
            'url'
        ];
    }
}

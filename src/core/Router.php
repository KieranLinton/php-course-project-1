<?php

class Router extends Entity
{

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

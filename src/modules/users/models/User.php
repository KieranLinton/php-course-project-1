<?php

class User extends AbstractEntity
{

    public function __construct(PDO $dbc)
    {
        parent::__construct($dbc, 'users');
    }

    protected function initFields()
    {
        $this->fields = [
            'id',
            'name',
            'username',
            'password',
            'password_hash'
        ];
    }
}

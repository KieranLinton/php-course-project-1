<?php

class UsernameValidator extends Validator
{
    public function __construct()
    {
        parent::__construct('username');
    }

    protected function getRules(): array
    {
        return [
            ValidationRules::minLength(3),
            ValidationRules::isEmail()
        ];
    }
}

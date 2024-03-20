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
            ValidationRules::minLength(5),
            ValidationRules::maxLength(30),
            ValidationRules::specialCharacters(0),
        ];
    }
}

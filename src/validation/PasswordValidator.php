<?php

class PasswordValidator extends Validator
{
    public function __construct()
    {
        parent::__construct('password');
    }

    protected function getRules(): array
    {
        return [
            ValidationRules::minLength(6),
            ValidationRules::maxLength(20),
            ValidationRules::specialCharacters(1),
        ];
    }
}

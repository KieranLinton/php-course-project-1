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
            new MinLengthCheck(6),
            new MaxLengthCheck(20),
            new SpecialCharacterCheck(true),
        ];
    }
}

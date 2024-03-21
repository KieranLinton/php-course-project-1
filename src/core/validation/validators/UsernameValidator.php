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
            new MinLengthCheck(3),
            new IsEmailCheck()
        ];
    }
}

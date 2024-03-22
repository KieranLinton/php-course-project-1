<?php

class UsernameValidator extends Validator
{
    public function __construct()
    {
        parent::__construct('username');
    }

    protected function getRuleList(): RuleList
    {
        return new RuleList(
            new MinLengthCheck(3),
            new IsEmailCheck()
        );
    }
}

<?php

class PasswordValidator extends Validator
{
    public function __construct()
    {
        parent::__construct('password');
    }

    protected function getRuleList(): RuleList
    {
        return new RuleList(
            new MinLengthCheck(6),
            new MaxLengthCheck(20),
            new NoEmptySpaceCheck(),
            new SpecialCharacterCheck(true)
        );
    }
}

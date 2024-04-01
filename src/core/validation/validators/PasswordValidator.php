<?php

namespace core\validation\validators;

use core\validation\AbstractValidator;
use core\validation\RuleList;
use core\validation\rules;


class PasswordValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct('password');
    }

    protected function getRuleList(): RuleList
    {
        return new RuleList(
            new rules\MinLengthCheck(6),
            new rules\MaxLengthCheck(20),
            new rules\NoEmptySpaceCheck(),
            new rules\SpecialCharacterCheck(true)
        );
    }
}

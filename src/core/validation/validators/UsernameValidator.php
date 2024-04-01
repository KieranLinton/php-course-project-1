<?php

namespace core\validation\validators;

use core\validation\AbstractValidator;
use core\validation\RuleList;
use core\validation\rules;

class UsernameValidator extends AbstractValidator
{
    public function __construct()
    {
        parent::__construct('username');
    }

    protected function getRuleList(): RuleList
    {
        return new RuleList(
            new rules\MinLengthCheck(3),
            new rules\IsEmailCheck()
        );
    }
}

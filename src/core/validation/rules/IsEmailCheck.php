<?php

namespace core\validation\rules;

use core\interfaces\ValidationRuleInterface;

class IsEmailCheck implements ValidationRuleInterface
{
    function validate(string $value): bool
    {
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);

        if (!$isEmail) {
            return false;
        }

        return true;
    }

    function getErrorMessage(): string
    {
        return "must be a valid email address";
    }
}

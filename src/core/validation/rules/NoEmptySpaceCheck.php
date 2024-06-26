<?php

namespace core\validation\rules;

use core\interfaces\ValidationRuleInterface;

class NoEmptySpaceCheck implements ValidationRuleInterface
{
    function validate(string $value): bool
    {
        if (strpos($value, ' ')) {
            return false;
        }

        return true;
    }

    function getErrorMessage(): string
    {
        return "must not contain empty spaces";
    }
}

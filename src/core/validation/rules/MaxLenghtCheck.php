<?php

namespace core\validation\rules;

use core\interfaces\ValidationRuleInterface;

class MaxLengthCheck implements ValidationRuleInterface
{
    private $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    public function validate(string $value): bool
    {
        if (strlen($value) > $this->length) {
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return "cannot be longer than $this->length characters";
    }
}

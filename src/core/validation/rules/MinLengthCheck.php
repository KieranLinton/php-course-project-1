<?php

class MinLengthCheck implements ValidationRuleInterface
{
    private $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    function validate(string $value): bool
    {
        if (strlen($value) < $this->length) {
            return false;
        }

        return true;
    }

    function getErrorMessage(): string
    {
        return "must be longer than $this->length characters";
    }
}

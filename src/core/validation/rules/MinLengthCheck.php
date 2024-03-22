<?php

class MinLengthCheck
{
    private $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    function validate($value)
    {
        if (strlen($value) < $this->length) {
            return false;
        }

        return true;
    }

    function getErrorMessage()
    {
        return "must be longer than $this->length characters";
    }
}

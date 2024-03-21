<?php

class MaxLengthCheck
{
    private $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    function validate($value)
    {
        if (strlen($value) > $this->length) {
            return "cannot be longer than $this->length characters.";
        }
    }
}

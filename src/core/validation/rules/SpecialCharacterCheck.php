<?php

class SpecialCharacterCheck
{
    private $enabled;

    public function __construct($enabled)
    {
        $this->enabled = $enabled;
    }


    function validate($value)
    {
        $foundSpecialChars = !!preg_match("/[^a-zA-Z0-9_]+/", $value);

        if (!$this->enabled && $foundSpecialChars) {
            return "must not contain special characters.";
        }

        if ($this->enabled && !$foundSpecialChars) {
            return "must contain at least one special character.";
        }
    }
}

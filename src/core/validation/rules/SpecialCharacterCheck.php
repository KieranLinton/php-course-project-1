<?php

class SpecialCharacterCheck
{
    private $enabled;
    private $errorMessage;

    public function __construct($enabled)
    {
        $this->enabled = $enabled;
    }

    function validate($value)
    {
        $foundSpecialChars = !!preg_match("/[^a-zA-Z0-9_]+/", $value);

        if (!$this->enabled && $foundSpecialChars) {
            $this->errorMessage = "must not contain special characters";
            return false;
        }

        if ($this->enabled && !$foundSpecialChars) {
            $this->errorMessage =  "must contain at least one special character";
            return false;
        }

        return true;
    }

    function getErrorMessage()
    {
        return $this->errorMessage;
    }
}

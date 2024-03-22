<?php

class IsEmailCheck
{
    function validate($value)
    {
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);

        if (!$isEmail) {
            return false;
        }

        return true;
    }

    function getErrorMessage()
    {
        return "must be a valid email address";
    }
}

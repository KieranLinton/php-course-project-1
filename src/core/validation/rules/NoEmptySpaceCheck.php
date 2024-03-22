<?php

class NoEmptySpaceCheck
{
    function validate($value)
    {
        if (strpos($value, ' ')) {
            return false;
        }

        return true;
    }

    function getErrorMessage()
    {
        return "must not contain empty spaces";
    }
}

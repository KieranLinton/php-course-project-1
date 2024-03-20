<?php

class ValidationRules
{
    public static function minLength(int $length)
    {
        return function (string $value) use ($length) {
            if (strlen($value) < $length) {
                return "must be longer than $length characters.";
            }
        };
    }

    public static function maxLength(int $length)
    {
        return function (string $value) use ($length) {
            if (strlen($value) > $length) {
                return "cannot be longer than $length characters.";
            }
        };
    }

    public static function specialCharacters(bool $enabled)
    {
        return function (string $value) use ($enabled) {

            $foundSpecialChars = !!preg_match("/[^a-zA-Z0-9_]+/", $value);

            if (!$enabled && $foundSpecialChars) {
                return "must not contain special characters.";
            }

            if ($enabled && !$foundSpecialChars) {
                return "must contain at least one special character.";
            }
        };
    }

    public static function isEmail()
    {
        return function (string $value) {

            $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);

            if (!$isEmail) {
                return "must be a valid email address";
            }
        };
    }
}

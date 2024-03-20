<?php

class ValidationRules
{
    public static function minLength(int $length)
    {
        return function (string $value) use ($length) {
            if (strlen($value) < $length) {
                return "Must be longer than $length characters.";
            }
        };
    }

    public static function maxLength(int $length)
    {
        return function (string $value) use ($length) {
            if (strlen($value) > $length) {
                return "Cannot be longer than $length characters.";
            }
        };
    }

    public static function specialCharacters(int $count)
    {
        return function (string $value) use ($count) {
            $clampedCount = max($count, 1);

            $isMatch = preg_match("/.*[*#&$%!?]{{$clampedCount}}.*/m", $value);

            if ($count < 1 && $isMatch) {
                return "Must not contain special characters (*#&$%!?).";
            }

            if ($count > 1 && !$isMatch) {
                return "Must contain at least one special character (*#&$%!?).";
            }
        };
    }
}

<?php

namespace core\interfaces;

interface ValidationRuleInterface
{
    public function validate(string $value): bool;
    public function getErrorMessage(): string;
}

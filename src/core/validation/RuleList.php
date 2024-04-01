<?php


namespace core\validation;

use core\interfaces\ValidationRuleInterface;


class RuleList
{

    private $rules;

    public function __construct(ValidationRuleInterface ...$rules)
    {
        $this->rules = $rules;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function appendRule(ValidationRuleInterface $rule)
    {
        array_push($this->rules, $rule);
        return $this;
    }
}

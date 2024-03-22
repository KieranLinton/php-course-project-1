<?php

abstract class Validator
{
    abstract protected function getRules(): array;
    protected $fieldName;


    protected function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }
    public function validate(string $data)
    {
        $rules = $this->getRules();
        foreach ($rules as $key => $rule) {
            $validationResult = $rule->validate($data);

            if (!$validationResult) {
                $errorMessage = $rule->getErrorMessage();
                return ucfirst($this->fieldName) . " $errorMessage.";
            }
        }
    }
}

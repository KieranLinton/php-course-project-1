<?php


namespace core\validation;

abstract class AbstractValidator
{
    private $fieldName;

    abstract protected function getRuleList(): RuleList;

    protected function __construct(string $fieldName)
    {
        $this->fieldName = $fieldName;
    }
    public function validate(string $data): ?string
    {

        $rules = $this->getRuleList()->getRules();
        foreach ($rules as $key => $rule) {
            $validationResult = $rule->validate($data);

            if (!$validationResult) {
                $errorMessage = $rule->getErrorMessage();
                return ucfirst($this->fieldName) . " $errorMessage.";
            }
        }

        return null;
    }
}

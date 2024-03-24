<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;


require_once 'src/core/interfaces/ValidationRuleInterface.php';
require_once 'src/core/validation/rules/IsEmailCheck.php';

final class ValidationTest extends TestCase
{
    public function testValidateEmail(): void
    {
        $emailValidation = new IsEmailCheck();

        $this->assertTrue($emailValidation->validate("test@test.com"));
        $this->assertFalse($emailValidation->validate("testt.com"));
        $this->assertFalse($emailValidation->validate("testt"));
        $this->assertFalse($emailValidation->validate("te@st@t.com"));
    }
}

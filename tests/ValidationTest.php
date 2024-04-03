<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use core\validation\rules\IsEmailCheck;


require_once 'src/core/interfaces/ValidationRuleInterface.php';
require_once 'src/core/validation/rules/IsEmailCheck.php';

final class ValidationTest extends TestCase
{
    public function testValidateEmail(): void
    {
        $emailValidation = new IsEmailCheck();

        $this->assertTrue($emailValidation->validate("test@test.com"));
        $this->assertFalse($emailValidation->validate("test.com"));
        $this->assertFalse($emailValidation->validate("test"));
        $this->assertFalse($emailValidation->validate("te@st@t.com"));
    }
}

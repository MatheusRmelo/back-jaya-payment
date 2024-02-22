<?php

namespace Tests\Unit;

use App\Enums\IdentificationType;
use PHPUnit\Framework\TestCase;

class IdentificationTypeTest extends TestCase
{
    /**
     * Test if Enum Identification Type have all values.
     */
    public function test_payment_status_have_all_values(): void
    {
        $this->assertTrue(in_array(IdentificationType::CPF, IdentificationType::VALUES));
        $this->assertTrue(in_array(IdentificationType::CNPJ, IdentificationType::VALUES));
    }
}

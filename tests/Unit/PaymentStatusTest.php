<?php

namespace Tests\Unit;

use App\Enums\PaymentStatus;
use PHPUnit\Framework\TestCase;

class PaymentStatusTest extends TestCase
{
    /**
     * Test if Enum Payment Status have all values.
     */
    public function test_payment_status_have_all_values(): void
    {
        $this->assertTrue(in_array(PaymentStatus::CANCELED, PaymentStatus::VALUES));
        $this->assertTrue(in_array(PaymentStatus::PAID, PaymentStatus::VALUES));
        $this->assertTrue(in_array(PaymentStatus::PENDING, PaymentStatus::VALUES));
    }
}

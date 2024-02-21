<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class PaymentStatus extends Enum
{
    const PENDING = "PENDING";
    const PAID = "PAID";
    const CANCELED = "CANCELED";
    const VALUES = [self::PENDING, self::PAID, self::CANCELED];
}

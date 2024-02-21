<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

final class IdentificationType extends Enum
{
    const CPF = "CPF";
    const CNPJ = "CNPJ";
    const VALUES = [self::CPF, self::CNPJ];
}

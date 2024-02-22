<?php

namespace Tests\Unit;

use App\Helpers\ValidateDocuments;
use PHPUnit\Framework\TestCase;

class ValidateDocumentsTest extends TestCase
{
    /**
     * Test if return valid documents
     */
    public function test_valid_documents(): void
    {
        $this->assertTrue(ValidateDocuments::validateCPF('064.066.350-86'));
        $this->assertTrue(ValidateDocuments::validateCPF('06406635086'));
        $this->assertTrue(ValidateDocuments::validateCNPJ('72.933.687/0001-29'));
        $this->assertTrue(ValidateDocuments::validateCNPJ('84064819000102'));
    }

    /**
     * Test if return invvalid documents
     */
    public function test_invalid_documents(): void
    {
        $this->assertFalse(ValidateDocuments::validateCPF('064.066.432-86'));
        $this->assertFalse(ValidateDocuments::validateCPF('06406612386'));
        $this->assertFalse(ValidateDocuments::validateCNPJ('72.424.687/0001-29'));
        $this->assertFalse(ValidateDocuments::validateCNPJ('84011819000102'));
    }
}

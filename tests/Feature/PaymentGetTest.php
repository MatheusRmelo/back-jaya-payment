<?php

namespace Tests\Feature;

use Database\Seeders\Tests\PaymentsTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentGetTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PaymentsTestSeeder::class);
        // $this->actingAs(User::find(1));
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    public function test_index_payment()
    {
        $this->json('GET', 'api/payments')
            ->assertStatus(200);
    }

    public function test_show_payment()
    {
        $id = '35e8c6a1-7904-4aee-a8e6-fbf75bdc138a';
        $this->json('GET', 'api/payments/' . $id)
            ->assertStatus(200);
    }

    public function test_not_found_payment()
    {
        $this->json('GET', 'api/payments/teste_not_found_id')
            ->assertStatus(404);

        $this->assertDatabaseMissing('payments', [
            'id' => 'teste_not_found_id'
        ]);
    }
}

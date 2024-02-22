<?php

namespace Tests\Feature;

use App\Enums\PaymentStatus;
use App\Models\User;
use Database\Seeders\Tests\PaymentsTestSeeder;
use Database\Seeders\UsersTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentCancelTest extends TestCase
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

    public function test_canceled_status()
    {
        $id = '35e8c6a1-7904-4aee-a8e6-fbf75bdc138a';
        $this->json('DELETE', 'api/payments/' . $id)
            ->assertStatus(204);
        $this->assertDatabaseHas('payments', [
            'id' => $id,
            'status' => PaymentStatus::CANCELED
        ]);
    }

    public function test_not_found_payment()
    {
        $this->json('DELETE', 'api/payments/teste_not_found_id')
            ->assertStatus(404);

        $this->assertDatabaseMissing('payments', [
            'id' => 'teste_not_found_id'
        ]);
    }
}

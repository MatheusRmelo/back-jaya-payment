<?php

namespace Tests\Feature;

use App\Enums\PaymentStatus;
use App\Models\User;
use Database\Seeders\Tests\PaymentsTestSeeder;
use Database\Seeders\UsersTestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentUpdateStatusTest extends TestCase
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

    /**
     * @dataProvider valid_status_data
     */
    public function test_valid_status(string $id, string $status)
    {
        $this->json('PATCH', 'api/payments/' . $id, ['status' => $status])
            ->assertStatus(204);
        $this->assertDatabaseHas('payments', [
            'id' => $id,
            'status' => $status
        ]);
    }

    /**
     * @dataProvider invalid_status_data
     */
    public function test_invalid_payment(string $id, array $data)
    {
        $this->json('PATCH', 'api/payments/' . $id, $data)
            ->assertStatus(422);

        $this->assertDatabaseMissing('payments', [
            'id' => $id,
            'status' => $data['status'] ?? ""
        ]);
    }

    public function test_not_found_payment()
    {
        $this->json('PATCH', 'api/payments/teste_not_found_id', ['status' => PaymentStatus::PAID])
            ->assertStatus(404);

        $this->assertDatabaseMissing('payments', [
            'id' => 'teste_not_found_id'
        ]);
    }

    /**-------- DATAS -------------------- */
    static public function valid_status_data()
    {
        return [
            'valid' => [
                '35e8c6a1-7904-4aee-a8e6-fbf75bdc138a',
                PaymentStatus::PENDING
            ],
        ];
    }

    static public function invalid_status_data()
    {
        return [
            'empty' => [
                '35e8c6a1-7904-4aee-a8e6-fbf75bdc138a',
                []
            ],
            'invalid-status' => [
                '35e8c6a1-7904-4aee-a8e6-fbf75bdc138a',
                [
                    "status" => "teste_invalido"
                ]
            ],
        ];
    }
}

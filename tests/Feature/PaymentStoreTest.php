<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PaymentStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // $this->seed(UsersTestSeeder::class);
        // $this->actingAs(User::find(1));
        $this->withHeaders([
            'Accept' => 'application/json'
        ]);
    }

    /**
     * @dataProvider valid_payment_data
     */
    public function test_valid_payment(array $payment)
    {
        $this->json('POST', 'api/payments', $payment)
            ->assertStatus(201);
        $this->assertDatabaseHas('payments', [
            'token' => $payment['token']
        ]);
        $this->assertDatabaseHas('payers', ['email' => $payment['payer']['email']]);
        $this->assertDatabaseHas('identifications', ['number' => $payment['payer']['identification']['number']]);
    }

    /**
     * @dataProvider invalid_payment_data
     */
    public function test_invalid_payment(array $payment)
    {
        $this->json('POST', 'api/payments', $payment)
            ->assertStatus(422);

        $this->assertDatabaseEmpty('payments');
    }

    /**-------- DATAS -------------------- */
    static public function valid_payment_data()
    {
        return [
            'valid' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
        ];
    }

    static public function invalid_payment_data()
    {
        return [
            'empty' => [
                []
            ],
            'without-transaction_amount' => [
                [
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-installments' => [
                [
                    "transaction_amount" => 15,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-token' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-payment_method_id' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-status' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-payer' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID"
                ]
            ],
            'without-email' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'invalid-email' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "testegmail",
                        "identification" => [
                            "type" => "CPF",
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-identification' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                    ]
                ]
            ],
            'without-type' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "number" => "06406635086"
                        ]
                    ]
                ]
            ],
            'without-number' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                        ]
                    ]
                ]
            ],
            'invalid-cpf' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => '99999999999'
                        ]
                    ]
                ]
            ],
            'invalid-cnpj' => [
                [
                    "transaction_amount" => 15,
                    "installments" => 1,
                    "token" => "weqwewqewqeeewqeewqew",
                    "payment_method_id" => "42",
                    "status" => "PAID",
                    "payer" => [
                        "email" => "teste@gmail.com",
                        "identification" => [
                            "type" => "CPF",
                            "number" => '99999999999999'
                        ]
                    ]
                ]
            ],
        ];
    }
}

<?php

namespace Database\Seeders\Tests;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class PaymentsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert([
            "id" => "35e8c6a1-7904-4aee-a8e6-fbf75bdc138a",
            "transaction_amount" => 15,
            "installments" => 1,
            "token" => "weqwewqewqeeewqeewqew",
            "payment_method_id" => "42",
            "status" => "PAID",
            'notification_url' => env('NOTIFICATION_URL_PAYMENT', 'http://localhost:8000')
        ]);
    }
}

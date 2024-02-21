<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_amount',
        'installments',
        'token',
        'payment_method_id',
        'notification_url',
        'status'
    ];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->{$payment->getKeyName()} = (string) Str::uuid();
        });
    }

    public function payer(): HasOne
    {
        return $this->hasOne(Payer::class);
    }
}

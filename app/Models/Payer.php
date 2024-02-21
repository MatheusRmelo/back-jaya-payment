<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Payer extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'entity_type',
        'type',
        'email'
    ];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payer) {
            $payer->{$payer->getKeyName()} = (string) Str::uuid();
        });
    }

    public function identification(): HasOne
    {
        return $this->hasOne(Identification::class);
    }
}

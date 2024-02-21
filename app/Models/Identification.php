<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Identification extends Model
{
    use HasFactory;

    protected $fillable = [
        'payer_id',
        'type',
        'number'
    ];

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($idenfication) {
            $idenfication->{$idenfication->getKeyName()} = (string) Str::uuid();
        });
    }
}

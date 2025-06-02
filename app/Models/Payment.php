<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mcu_registration_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'payment_date',
        'notes'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2'
    ];

    /**
     * Get the MCU registration that owns the payment.
     */
    public function mcuRegistration()
    {
        return $this->belongsTo(McuRegistration::class);
    }
} 
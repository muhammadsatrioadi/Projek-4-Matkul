<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McuRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hospital_id',
        'registration_number',
        'mcu_package',
        'appointment_date',
        'appointment_time',
        'status',
        'medical_notes'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

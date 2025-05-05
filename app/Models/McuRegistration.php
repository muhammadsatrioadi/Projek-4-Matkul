<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class McuRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'hospital_id',
        'registration_number',
        'mcu_package',
        'appointment_date',
        'appointment_time',
        'medical_notes',
        'status',
        'total_cost',
        'payment_status'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'total_cost' => 'decimal:2'
    ];

    public static function generateRegistrationNumber()
    {
        $prefix = 'MCU';
        $date = now()->format('Ymd');
        $lastNumber = self::whereDate('created_at', today())
            ->max('registration_number');
        
        if ($lastNumber) {
            $sequence = (int)substr($lastNumber, -4) + 1;
        } else {
            $sequence = 1;
        }
        
        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

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

    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('appointment_date', '>=', now())
            ->whereNotIn('status', ['completed', 'cancelled']);
    }

    public function scopePast($query)
    {
        return $query->where('appointment_date', '<', now())
            ->orWhereIn('status', ['completed', 'cancelled']);
    }
}

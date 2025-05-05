<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'mcu_registration_id',
        'record_number',
        'examination_date',
        'diagnosis',
        'treatment',
        'doctor_notes',
        'lab_results',
        'status'
    ];

    protected $casts = [
        'examination_date' => 'date',
        'lab_results' => 'array'
    ];

    public function mcuRegistration()
    {
        return $this->belongsTo(McuRegistration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public static function generateRecordNumber()
    {
        $prefix = 'MR';
        $date = now()->format('Ymd');
        $lastNumber = self::whereDate('created_at', today())
            ->max('record_number');
        
        if ($lastNumber) {
            $sequence = (int)substr($lastNumber, -4) + 1;
        } else {
            $sequence = 1;
        }
        
        return $prefix . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
} 
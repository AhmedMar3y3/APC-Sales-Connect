<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Visit extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'representative_id',
        'doctor_id',
        'pharmacy_id',
        'medication_id',
        'date',
        'time',
        'notes',
        'status',
        'is_sold',
        'points',
        'rating',
    ];
    public function representative()
    {
        return $this->belongsTo(User::class, 'representative_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }
}

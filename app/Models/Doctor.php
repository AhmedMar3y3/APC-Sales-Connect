<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Doctor extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'address',
        'details',
        'image',
        'longitude',
        'latitude',
    ];
    public function notes()
{
    return $this->hasMany(Note::class);
}

}

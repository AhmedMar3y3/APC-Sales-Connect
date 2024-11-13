<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 
        'supervisor_id', 
        'status'
    ];

    public function supervisor() {
        return $this->belongsTo(Supervisor::class);
    }
}

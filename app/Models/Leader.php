<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leader extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'name',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function supervisors() {
        return $this->hasMany(Supervisor::class);
    }
}

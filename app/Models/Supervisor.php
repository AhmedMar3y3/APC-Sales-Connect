<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'leader_id',
        'role',
    ];

    public function leader() {
        return $this->belongsTo(Leader::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}

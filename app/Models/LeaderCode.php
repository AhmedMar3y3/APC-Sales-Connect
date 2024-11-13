<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderCode extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'status', 'leader_id'];

    public function leader()
    {
        return $this->belongsTo(Leader::class, 'leader_id');
    }
}

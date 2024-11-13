<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCode extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'status', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MonthlyTarget extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'user_id',
        'target',
        'completed_visits',
        'month',
    ];


    public function representative()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function completedVisits()
{
    $currentMonth = $this->month;
    return $this->representative->visits()
        ->where('status', 'أكتملت')
        ->whereMonth('date', $currentMonth)
        ->count();
}
}

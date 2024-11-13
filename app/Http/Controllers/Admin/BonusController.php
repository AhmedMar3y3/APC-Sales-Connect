<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visit;

class BonusController extends Controller
{
    public function viewBonus()
    {
        $representatives = User::withSum('visits', 'points')
                               ->orderByDesc('visits_sum_points')
                               ->get();

        return view('admin.bonus.index', compact('representatives'));
    }
}

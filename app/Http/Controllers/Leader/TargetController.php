<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class TargetController extends Controller
{
    public function viewTargets($representativeId)
    {
        $representative = User::findOrFail($representativeId);
        $targets = $representative->monthlyTargets->map(function ($target) use ($representative) {
            $monthYear = explode('-', $target->month);
            $year = $monthYear[0];
            $month = $monthYear[1];
    
            $completedVisits = $representative->visits()
                ->where('status', 'أكتملت')
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->count();
    
            $monthlyPoints = $representative->monthlyPoints()
                ->where('month', $target->month)
                ->first();
    
            $target->completed_visits = $completedVisits;
            $target->points = $monthlyPoints ? $monthlyPoints->points : 0;
    
            return $target;
        });
    
        return view('Leader.target.view', compact('representative', 'targets'));
    }
    
  //create target
  public function createTarget($representativeId)
{
  $representative = User::findOrFail($representativeId);
  return view('Leader.target.create', compact('representative'));
}

//store target
public function storeTarget(Request $request, $representativeId)
{
  $request->validate([
      'target' => 'required|integer|min:1',
      'month' => 'required|string',
  ]);
  $representative = User::findOrFail($representativeId);
  $existingTarget = $representative->monthlyTargets()->where('month', $request->month)->first();
  if ($existingTarget) {
      return redirect()->back()->with('error', 'Target for this month already exists.');
  }
  $representative->monthlyTargets()->create([
      'target' => $request->input('target'),
      'month' => $request->input('month'),
  ]);

  return redirect()->route('leader.representatives.index')->with('success', 'Monthly target created successfully.');
}


//edit target
public function editTarget($representativeId, $targetId)
{
  $representative = User::findOrFail($representativeId);
  $target = $representative->monthlyTargets()->findOrFail($targetId);

  return view('Leader.target.edit', compact('representative', 'target'));
}

// update target
public function updateTarget(Request $request, $representativeId, $targetId)
{
  $request->validate([
      'target' => 'required|integer|min:1',
      'month' => 'required|string',
  ]);

  $representative = User::findOrFail($representativeId);
  $target = $representative->monthlyTargets()->findOrFail($targetId);

  $target->update([
      'target' => $request->input('target'),
      'month' => $request->input('month'),
  ]);

  return redirect()->route('leader.target.view', $representative->id)->with('success', 'Target updated successfully.');
}

// delete a target
public function deleteTarget($representativeId, $targetId)
{
  $representative = User::findOrFail($representativeId);
  $target = $representative->monthlyTargets()->findOrFail($targetId);

  $target->delete();

  return redirect()->route('leader.target.view', $representative->id)->with('success', 'Target deleted successfully.');
}

}

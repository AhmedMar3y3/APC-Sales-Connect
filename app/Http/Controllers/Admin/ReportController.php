<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index()
    {
        $representatives = User::all();
        return view('admin.reports.index', compact('representatives'));
    }
    public function viewMonthlyReports(Request $request, $id)
    {
        // Fetch the month in the format YYYY-MM
        $inputMonth = $request->get('month', Carbon::now()->format('Y-m'));
    
        // Split the input to get year and month separately
        [$year, $month] = explode('-', $inputMonth);
    
        // Find the specific representative by ID
        $representative = User::findOrFail($id);
    
        // Get all visits for the representative in the given month and year
        $visits = Visit::where('representative_id', $representative->id)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->with(['doctor', 'pharmacy', 'medication']) // Eager load relationships
            ->get();
    
        // Calculate the report data
        $totalVisits = $visits->count();
        $completedVisits = $visits->where('status', 'أكتملت')->count();
        $pendingVisits = $visits->where('status', 'قيد الأنتظار')->count();
        $salesVisits = $visits->where('is_sold', true)->count();
        $noSalesVisits = $visits->where('is_sold', false)->count();
    
        // Get the most sold medication in the month
        $mostSoldMedicationId = $visits->groupBy('medication_id')
            ->sortByDesc(function($medications) {
                return $medications->count();
            })->keys()->first();
    
        $mostSoldMedication = $mostSoldMedicationId ? optional($visits->firstWhere('medication_id', $mostSoldMedicationId)->medication)->name : null;
    
        // Collect doctor and pharmacy data
        $doctors = $visits->groupBy('doctor_id')->map(function($visits) {
            $doctor = optional($visits->first()->doctor); // Use optional() to avoid null errors
            return [
                'name' => $doctor->name ?? 'N/A',
                'count' => $visits->count()
            ];
        });
    
        $pharmacies = $visits->groupBy('pharmacy_id')->map(function($visits) {
            $pharmacy = optional($visits->first()->pharmacy); // Use optional() to avoid null errors
            return [
                'name' => $pharmacy->name ?? 'N/A',
                'count' => $visits->count()
            ];
        });
    
        $report = [
            'representative' => $representative,
            'total_visits' => $totalVisits,
            'completed_visits' => $completedVisits,
            'pending_visits' => $pendingVisits,
            'most_sold_medication' => $mostSoldMedication,
            'sales_visits' => $salesVisits,
            'no_sales_visits' => $noSalesVisits,
            'doctors' => $doctors,
            'pharmacies' => $pharmacies,
        ];
    
        return view('admin.reports.show', compact('report', 'month', 'year'));
    }

public function downloadMonthlyReportPdf(Request $request, $id)
{
    $inputMonth = $request->get('month', Carbon::now()->format('Y-m'));
    [$year, $month] = explode('-', $inputMonth);

    $representative = User::findOrFail($id);

    $visits = Visit::where('representative_id', $representative->id)
        ->whereYear('date', $year)
        ->whereMonth('date', $month)
        ->with(['doctor', 'pharmacy', 'medication'])
        ->get();

    $totalVisits = $visits->count();
    $completedVisits = $visits->where('status', 'أكتملت')->count();
    $pendingVisits = $visits->where('status', 'قيد الأنتظار')->count();
    $salesVisits = $visits->where('is_sold', true)->count();
    $noSalesVisits = $visits->where('is_sold', false)->count();

    $mostSoldMedicationId = $visits->groupBy('medication_id')
        ->sortByDesc(function($medications) {
            return $medications->count();
        })->keys()->first();

    $mostSoldMedication = $mostSoldMedicationId ? optional($visits->firstWhere('medication_id', $mostSoldMedicationId)->medication)->name : null;

    $doctors = $visits->groupBy('doctor_id')->map(function($visits) {
        $doctor = optional($visits->first()->doctor);
        return [
            'name' => $doctor->name ?? 'N/A',
            'count' => $visits->count()
        ];
    });

    $pharmacies = $visits->groupBy('pharmacy_id')->map(function($visits) {
        $pharmacy = optional($visits->first()->pharmacy);
        return [
            'name' => $pharmacy->name ?? 'N/A',
            'count' => $visits->count()
        ];
    });

    $report = [
        'representative' => $representative,
        'total_visits' => $totalVisits,
        'completed_visits' => $completedVisits,
        'pending_visits' => $pendingVisits,
        'most_sold_medication' => $mostSoldMedication,
        'sales_visits' => $salesVisits,
        'no_sales_visits' => $noSalesVisits,
        'doctors' => $doctors,
        'pharmacies' => $pharmacies,
    ];

    $pdf = Pdf::loadView('admin.reports.pdf', compact('report', 'month', 'year'));
    return $pdf->download("monthly_report_{$month}_{$year}.pdf");
}

    

    
}

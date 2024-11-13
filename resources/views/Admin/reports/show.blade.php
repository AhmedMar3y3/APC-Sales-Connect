@extends('Admin.layout')
@section('main')

<div class="container">
    <h1>Monthly Report for {{ $report['representative']->name }} - {{ $month }}/{{ $year }}</h1>
    
    <form action="{{ route('admin.reports.show', $report['representative']->id) }}" method="GET">
        <div class="form-group">
            <label for="month">Select Month</label>
            <input type="month" id="month" name="month" value="{{ $year }}-{{ $month }}" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">View Report</button>
    </form>

    <table class="table table-bordered mt-4">
        <tbody>
            <tr>
                <th>Total Visits</th>
                <td>{{ $report['total_visits'] }}</td>
            </tr>
            <tr>
                <th>Completed Visits</th>
                <td>{{ $report['completed_visits'] }}</td>
            </tr>
            <tr>
                <th>Pending Visits</th>
                <td>{{ $report['pending_visits'] }}</td>
            </tr>
            <tr>
                <th>Most Sold Medication</th>
                <td>{{ $report['most_sold_medication'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Sales Visits</th>
                <td>{{ $report['sales_visits'] }}</td>
            </tr>
            <tr>
                <th>No Sales Visits</th>
                <td>{{ $report['no_sales_visits'] }}</td>
            </tr>
            @if($report['doctors']->where('name', '!=', 'N/A')->count())
            <tr>
                <th>Doctors Visited</th>
                <td>
                    @foreach ($report['doctors'] as $doctor)
                        @if($doctor['name'] !== 'N/A')
                            {{ $doctor['name'] }} ({{ $doctor['count'] }} times)<br>
                        @endif
                    @endforeach
                </td>
            </tr>
            @endif
            @if($report['pharmacies']->where('name', '!=', 'N/A')->count())
            <tr>
                <th>Pharmacies Visited</th>
                <td>
                    @foreach ($report['pharmacies'] as $pharmacy)
                        @if($pharmacy['name'] !== 'N/A')
                            {{ $pharmacy['name'] }} ({{ $pharmacy['count'] }} times)<br>
                        @endif
                    @endforeach
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    <form action="{{ route('admin.reports.download', $report['representative']->id) }}" method="GET" class="mb-3">
        <input type="hidden" name="month" value="{{ $year }}-{{ $month }}">
        <button type="submit" class="btn btn-secondary">Download as PDF</button>
    </form>
    
</div>
@endsection

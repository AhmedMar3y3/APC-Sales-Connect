<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h1>Monthly Report for {{ $report['representative']->name }} - {{ $month }}/{{ $year }}</h1>

<table>
    <tbody>
        <tr><th>Total Visits</th><td>{{ $report['total_visits'] }}</td></tr>
        <tr><th>Completed Visits</th><td>{{ $report['completed_visits'] }}</td></tr>
        <tr><th>Pending Visits</th><td>{{ $report['pending_visits'] }}</td></tr>
        <tr><th>Most Sold Medication</th><td>{{ $report['most_sold_medication'] ?? 'N/A' }}</td></tr>
        <tr><th>Sales Visits</th><td>{{ $report['sales_visits'] }}</td></tr>
        <tr><th>No Sales Visits</th><td>{{ $report['no_sales_visits'] }}</td></tr>
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

</body>
</html>

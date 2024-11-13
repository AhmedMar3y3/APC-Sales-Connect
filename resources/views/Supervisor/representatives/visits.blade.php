@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h2>Visit Details</h2>
    @if($representative->visits->isEmpty())
    <p>No visits recorded for this representative.</p>
@else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Doctor</th>
                <th>Pharmacy</th>
                <th>Medication</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($representative->visits as $visit)
                <tr>
                    <td>{{ $visit->date }}</td>
                    <td>{{ $visit->time }}</td>
                    <td>{{ $visit->doctor->name ?? 'N/A' }}</td>
                    <td>{{ $visit->pharmacy->name ?? 'N/A' }}</td>
                    <td>{{ $visit->medication->name ?? 'N/A' }}</td>
                    <td>{{ $visit->notes ?? 'No notes available' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

</div>
@endsection

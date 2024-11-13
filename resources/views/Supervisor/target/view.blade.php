@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h1>Targets for {{ $representative->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Month</th>
                <th>Target</th>
                <th>Completed Visits</th>
                <th>Completion Rate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($targets as $target)
                <tr>
                    <td>{{ $target->month }}</td>
                    <td>{{ $target->target }}</td>
                    <td>{{ $target->completed_visits }}</td>
                    <td>{{ ($target->completed_visits / $target->target) * 100 }}%</td>
                    <td>
                        <a href="{{ route('supervisor.target.edit', [$representative->id, $target->id]) }}" class="btn btn-warning btn-sm">  <i class="fas fa-edit"></i> <!-- Edit icon --></a>

                        <form action="{{ route('supervisor.target.delete', [$representative->id, $target->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"> <i class="fas fa-trash-alt"></i> <!-- Delete icon --></button>
                        </form>

                  
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('supervisor.representatives.index') }}" class="btn btn-secondary">Back to Representatives</a>
</div>
@endsection

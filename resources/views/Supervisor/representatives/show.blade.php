@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h1>Details of {{ $representative->name }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Representative Information</h5>
            <p><strong>Name:</strong> {{ $representative->name }}</p>
            <p><strong>Email:</strong> {{ $representative->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($representative->role) }}</p>
            <div class="mb-3">
                @if($representative->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/images/users/' . basename($representative->image)) }}" alt="Image" style="width: 100px;">
                @else
                    <p>No image available.</p>
                @endif
            </div>
        </div>
    </div>

    <a href="{{ route('supervisor.representatives.visitCreate', $representative->id) }}" class="btn btn-success mb-3">Create New Visit</a>
  
    <h2>Visits</h2>
    @if($representative->visits->isEmpty())
        <p>No visits recorded for this representative.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Medication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($representative->visits as $visit)
                    <tr>
                        <td>{{ $visit->date }}</td>
                        <td>{{ $visit->time }}</td>
                        <td>{{ $visit->medication->name ?? 'N/A' }}</td> <!-- Medication might be null -->
                        <td>
                            <a href="{{ route('supervisor.representatives.visits', ['representativeId' => $representative->id, 'visitId' => $visit->id]) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('supervisor.representatives.visits.edit', ['representativeId' => $representative->id, 'visitId' => $visit->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('supervisor.representatives.visits.destroy', ['representativeId' => $representative->id, 'visitId' => $visit->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection

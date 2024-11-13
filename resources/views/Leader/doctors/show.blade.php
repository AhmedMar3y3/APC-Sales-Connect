@extends('Leader.layout')

@section('main')
<div class="container">
    <h1>Doctor Details</h1>
    
    <div class="mb-3">
        <strong>Name:</strong> {{ $doctor->name }}
    </div>
    <div class="mb-3">
        <strong>Specialization:</strong> {{ $doctor->specialization }}
    </div>
    <div class="mb-3">
        <strong>Phone:</strong> {{ $doctor->phone }}
    </div>
    <div class="mb-3">
        <strong>Address:</strong> {{ $doctor->address }}
    </div>
    <div class="mb-3">
        <strong>Details:</strong> {{ $doctor->details }}
    </div>
    
    <div class="mb-3">
        @if($doctor->image)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('doctors/' . basename($doctor->image)) }}" alt="Image" style="width: 100px;">
        @else
            <p>No image available.</p>
        @endif
    </div>

    <!-- Add a section to display the notes -->
    <div class="mb-3">
        <h3>Notes:</h3>
        @if($doctor->notes->isEmpty())
            <p>No notes available for this doctor.</p>
        @else
            <ul>
                @foreach($doctor->notes as $note)
                    <li>
                        <strong>{{ $note->user->name }}:</strong> {{ $note->note }} <br>
                        <small><i>Added on {{ $note->created_at->format('Y-m-d H:i') }}</i></small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <a href="{{ route('leader.doctors.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection

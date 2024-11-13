@extends('Admin.layout')

@section('main')
<div class="container">
    <h1>Pharmacy Details</h1>
    <div class="mb-3">
        <strong>Name:</strong> {{ $pharmacy->name }}
    </div>
    <div class="mb-3">
        <strong>Phone:</strong> {{ $pharmacy->phone }}
    </div>
    <div class="mb-3">
        <strong>Address:</strong> {{ $pharmacy->address }}
    </div>
    <div class="mb-3">
        <strong>Details:</strong> {{ $pharmacy->details }}
    </div>
    <div class="mb-3">
        @if($pharmacy->image)
             <p><strong>Image:</strong></p>
             <img src="{{ asset('pharmacies/' . basename($pharmacy->image)) }}" alt="Image" style="width: 100px;">
         @else
             <p>No image available.</p>
         @endif    </div>
         
    <!-- Add a section to display the notes -->
    <div class="mb-3">
        <h3>Notes:</h3>
        @if($pharmacy->notes->isEmpty())
            <p>No notes available for this pharmacy.</p>
        @else
            <ul>
                @foreach($pharmacy->notes as $note)
                    <li>
                        <strong>{{ $note->user->name }}:</strong> {{ $note->note }} <br>
                        <small><i>Added on {{ $note->created_at->format('Y-m-d H:i') }}</i></small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <a href="{{ route('admin.pharmacies.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
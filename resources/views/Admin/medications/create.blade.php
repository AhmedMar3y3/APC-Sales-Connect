@extends('Admin.layout')

@section('main')
    <div class="container">
        <h2>Add Medication</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.medications.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Medication Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Medication</button>
        </form>
    </div>
@endsection

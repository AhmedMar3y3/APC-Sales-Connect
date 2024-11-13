@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h1>Add Doctor</h1>
    <form action="{{ route('supervisor.doctors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization" value="{{ old('specialization') }}">
            @error('specialization')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
       
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea class="form-control" id="details" name="details">{{ old('details') }}</textarea>
            @error('details')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection

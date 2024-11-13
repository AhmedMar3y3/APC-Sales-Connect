@extends('Admin.layout')

@section('main')
<div class="container">
    <h1>Edit Doctor</h1>
    <form action="{{ route('admin.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $doctor->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="specialization" class="form-label">Specialization</label>
            <input type="text" class="form-control" id="specialization" name="specialization" value="{{ old('specialization', $doctor->specialization) }}">
            @error('specialization')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $doctor->address) }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <input type="text" class="form-control" id="details" name="details" value="{{ old('details', $doctor->details) }}">
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
            @if($doctor->image)
                <div class="mt-2">
                    <img src="{{ asset('doctors/' . $doctor->image) }}" alt="Image" style="width: 100px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

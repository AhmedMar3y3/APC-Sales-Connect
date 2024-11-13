@extends('Admin.layout')

@section('main')
<div class="container">
    <h1>Edit Pharmacy</h1>
    <form action="{{ route('admin.pharmacies.update', $pharmacy->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $pharmacy->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $pharmacy->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $pharmacy->address) }}">
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <input type="text" class="form-control" id="details" name="details" value="{{ old('details', $pharmacy->details) }}">
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
            @if($pharmacy->image)
                <div class="mt-2">
                    <img src="{{ asset('pharmacies/' . $pharmacy->image) }}" alt="Image" style="width: 100px;">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pharmacies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

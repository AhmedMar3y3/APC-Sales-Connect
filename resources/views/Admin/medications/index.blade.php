@extends('Admin.layout')

@section('main')
  <div class="container">
        <h2>All Medications</h2>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('admin.medications.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by medication name" value="{{ request('search') }}">
                <div class="input-group-append" style="margin-left: 10px;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>
        </form>

        <!-- Button to Create a new Medication -->
        <a href="{{ route('admin.medications.create') }}" class="btn btn-primary mb-3">Add New Medication</a>

        <!-- Table to list all medications -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medications as $medication)
                    <tr>
                        <td>{{ $medication->id }}</td>
                        <td>{{ $medication->name }}</td>
                        <td>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.medications.destroy', $medication->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this medication?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>                           
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No medications found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

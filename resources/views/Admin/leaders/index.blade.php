@extends('Admin.layout')
@section('main')
<div class="container">
    <h2>All Leaders</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table to list all medications -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>email</th>
                <th>role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leaders as $leader)
                <tr>
                    <td>{{ $leader->id }}</td>
                    <td>{{ $leader->name }}</td>
                    <td>{{ $leader->email }}</td>
                    <td>{{ $leader->role }}</td>
                    <td>
                        <!-- View Button -->
                        <a href="{{ route('admin.leaders.supervisors', $leader->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> View Supervisors
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Leaders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
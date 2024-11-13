@extends('Leader.layout')
@section('main')
<div class="container">
    <h2>All Supervisors</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table to list all supervisors -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($supervisors as $supervisor)
                <tr>
                    <td>{{ $supervisor->id }}</td>
                    <td>{{ $supervisor->email }}</td>
                    <td>{{ $supervisor->name }}</td>
                    <td>
                        <!-- Single View Button for each supervisor -->
                        <a href="{{ route('leader.supervisor.viewRepresentatives', $supervisor->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> View Representatives
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No Supervisors found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h1>Representatives</h1>

    <!-- Search Form -->
    <form action="{{ route('supervisor.representatives.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by representative name or email" value="{{ request('search') }}">
                <div class="input-group-append" style="margin-left: 10px;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
            </div>
        </div>
    </form>

    <!-- List of Representatives -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($representatives as $representative)
                <tr>
                    <td>{{ $representative->name }}</td>
                    <td>{{ $representative->email }}</td>
                    <td>{{ ucfirst($representative->role) }}</td>
                    <td>
                        <a href="{{ route('supervisor.representatives.show', $representative->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('supervisor.target.create', $representative->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Add Target
                        </a>
                        <a href="{{ route('supervisor.target.view', $representative->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> View Targets
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No representatives found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

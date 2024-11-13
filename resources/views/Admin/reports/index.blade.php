@extends('Admin.layout')
@section('main')


<div class="container">
    <h1>Reports</h1>

    <!-- List of Representatives -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($representatives as $index => $representative)
                <tr>
                    <td>{{ $representative->name }}</td>
                    <td>{{ ucfirst($representative->role) }}</td>

                    <td>

                        <a href="{{ route('admin.reports.show', $representative->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> View Reports
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No representatives found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
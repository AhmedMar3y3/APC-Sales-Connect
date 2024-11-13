@extends('Admin.layout')
@section('main')

<div class="container">
    <h1>Bonus</h1>

    <!-- List of Representatives -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Points</th>
                <th>Rank</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($representatives as $index => $representative)
                <tr>
                    <td>{{ $representative->name }}</td>
                    <td>{{ ucfirst($representative->role) }}</td>
                    <td>{{ $representative->visits_sum_points ?? 0 }}</td> <!-- Display total points -->

                    <!-- Assign Medals based on Rank -->
                    <td>
                        @if($index == 0)
                            <span>🥇 Gold</span>
                        @elseif($index == 1)
                            <span>🥈 Silver</span>
                        @elseif($index == 2)
                            <span>🥉 Bronze</span>
                        @else
                            {{ $index + 1 }}
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.representatives.show', $representative->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View
                        </a>
                        <a href="{{ route('admin.target.view', $representative->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> View Targets
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

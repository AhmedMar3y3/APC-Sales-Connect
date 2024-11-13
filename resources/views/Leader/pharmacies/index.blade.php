@extends('Leader.layout')

@section('main')
<div class="container">
    <h1>Pharmacies</h1>
    <!-- Search Form -->
    <form action="{{ route('leader.pharmacies.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by pharmacy name" value="{{ request('search') }}">
                <div class="input-group-append" style="margin-left: 10px;">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Search
                    </button>
            </div>
        </div>
    </form>
    <a href="{{ route('leader.pharmacies.create') }}" class="btn btn-primary mb-3">Add Pharmacy</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $pharmacy->name }}</td>
                    <td>{{ $pharmacy->phone }}</td>
                    <td>
                        <a href="{{ route('leader.pharmacies.show', $pharmacy->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> <!-- View icon -->
                        </a>
                        <a href="{{ route('leader.pharmacies.edit', $pharmacy->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> <!-- Edit icon -->
                        </a>
                        <form action="{{ route('leader.pharmacies.destroy', $pharmacy->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

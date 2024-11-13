@extends('Admin.layout')
@section('main')
<div class="container">
    <h2>All Representatives</h2>

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
                <th>email</th>
                <th>name</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($representatives as $representative)
            <tr>
                <td>{{ $representative->id }}</td>
                <td>{{ $representative->email }}</td>
                <td>{{ $representative->name }}</td>
               
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Representatives found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
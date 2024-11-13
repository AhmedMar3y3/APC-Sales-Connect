@extends('Leader.layout')

@section('main')
<div class="container">
    <h1>Create Monthly Target for {{ $representative->name }}</h1>

    <form action="{{ route('leader.target.store', $representative->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="target">Target Number of Visits:</label>
            <input type="number" class="form-control" id="target" name="target" required>
        </div>

        <div class="form-group">
            <label for="month">Month:</label>
            <input type="text" class="form-control" id="month" name="month" placeholder="YYYY-MM" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Target</button>
    </form>
</div>
@endsection

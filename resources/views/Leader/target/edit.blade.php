@extends('Leader.layout')

@section('main')
<div class="container">
    <h1>Edit Target for {{ $representative->name }}</h1>

    <form action="{{ route('leader.target.update', [$representative->id, $target->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="month">Month</label>
            <input type="text" name="month" class="form-control" value="{{ old('month', $target->month) }}">
        </div>

        <div class="form-group">
            <label for="target">Target</label>
            <input type="number" name="target" class="form-control" value="{{ old('target', $target->target) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Target</button>
    </form>

    <a href="{{ route('leader.target.view', $representative->id) }}" class="btn btn-secondary mt-3">Back to Targets</a>
</div>
@endsection

@extends('Admin.layout')

@section('main')
<div class="container">
    <h1>Edit Visit for {{ $representative->name }}</h1>

    <form action="{{ route('admin.representatives.visits.update', [$representative->id, $visit->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" value="{{ $visit->date }}">
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" name="time" value="{{ $visit->time }}">
        </div>

        <div class="mb-3">
            <label for="medication_id" class="form-label">Medication</label>
            <select name="medication_id" class="form-control">
                @foreach($medications as $medication)
                    <option value="{{ $medication->id }}" {{ $visit->medication_id == $medication->id ? 'selected' : '' }}>{{ $medication->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes">{{ $visit->notes }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="قيد الأنتظار" {{ $visit->status == 'قيد الأنتظار' ? 'selected' : '' }}>قيد الأنتظار</option>
                <option value="جارية" {{ $visit->status == 'جارية' ? 'selected' : '' }}>جارية</option>
                <option value="أكتملت" {{ $visit->status == 'أكتملت' ? 'selected' : '' }}>أكتملت</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Visit</button>
    </form>
</div>
@endsection

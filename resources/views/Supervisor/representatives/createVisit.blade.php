@extends('Supervisor.layout')

@section('main')
<div class="container">
    <h1>Add Visit for {{ $representative->name }}</h1>

    <form action="{{ route('supervisor.representatives.visits.store', $representative->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
        </div>

        <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" name="time" required>
        </div>

        <div class="mb-3">
            <label for="medication_id" class="form-label">Medication</label>
            <select name="medication_id" class="form-control" required>
                @foreach($medications as $medication)
                    <option value="{{ $medication->id }}">{{ $medication->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Conditionally show the Doctor field if the representative role is 'scientific' -->
        @if($representative->role === 'علمي')
        <div class="mb-3">
            <label for="doctor_id" class="form-label">Doctor</label>
            <select name="doctor_id" class="form-control">
                <option value="">Select Doctor</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <!-- Pharmacy field (available for both scientific and commercial representatives) -->
        <div class="mb-3">
            <label for="pharmacy_id" class="form-label">Pharmacy</label>
            <select name="pharmacy_id" class="form-control">
                <option value="">Select Pharmacy</option>
                @foreach($pharmacies as $pharmacy)
                    <option value="{{ $pharmacy->id }}">{{ $pharmacy->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" name="notes"></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="قيد الأنتظار">قيد الأنتظار</option>
                <option value="جارية">جارية</option>
                <option value="أكتملت">أكتملت</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Visit</button>
    </form>
</div>
@endsection

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeVisitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'time' => 'required|date_format:H:i',
            'medication_id' => 'required|exists:medications,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'pharmacy_id' => 'nullable|exists:pharmacies,id',
            'notes' => 'nullable|string',
            'status' => 'nullable|in:قيد الأنتظار,جارية,أكتملت',
        ];
    }
}

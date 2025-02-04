<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateDoctorRequest extends FormRequest
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
            'name' => 'nullable|string',
            'specialization' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'details' => 'nullable|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,svg',
        ];
    }
}

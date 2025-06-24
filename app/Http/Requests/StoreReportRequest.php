<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Adjust authorization logic as needed
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'joined_date' => 'required|date',
            'exits_date' => 'nullable|date|after_or_equal:joined_date',
            'user_id' => 'required|exists:users,id',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'joined_date.required' => 'The joined date is required.',
            'joined_date.date' => 'The joined date must be a valid date.',
            'exits_date.date' => 'The exit date must be a valid date.',
            'exits_date.after_or_equal' => 'The exit date must be on or after the joined date.',
            'user_id.required' => 'The user ID is required.',
            'user_id.exists' => 'The selected user does not exist.',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBorrowingRequest extends FormRequest
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
            //
            'user_id'     => 'sometimes|exists:users,id',
            'book_id'     => 'sometimes|exists:books,id',
            'borrow_date' => 'nullable|date',
            'return_date' => 'nullable|date',
            'status'      => 'nullable|string|in:borrowed,returned,late'
        ];
    }
}

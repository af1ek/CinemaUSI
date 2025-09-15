<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'screening_id' => ['required', 'integer', 'exists:screenings,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'reserved_tickets' => ['required', 'integer'],
            'status' => ['required', 'in:placed,confirmed,canceled'],
        ];
    }
}

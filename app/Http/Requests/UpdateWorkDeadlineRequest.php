<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkDeadlineRequest extends FormRequest
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
            'name' => 'string',
            'start_date' => 'date',
            'end_date' => 'date|after_or_equal:start_date',
        ];
    }

    public function message()
    {
        return [
            'end_date.after_or_equal' => 'End date must be after start date',
        ];
    }
}

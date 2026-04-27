<?php

namespace App\Http\Requests\Admin\Competition;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompetitionRequest extends FormRequest
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
            'competition_type' => 'required|in:E-Sports,Non-E-Sports',
            'slug' => 'nullable|alpha_num|in:Ia1Dh6sZdQ,dZ4AnskCXj,7lTI2n5EDK,I5njJtbe5J',
            'competition_name' => 'required|string|max:50',
            'competition_end_date' => 'required|date',
            'competition_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_second_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_third_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_description' => 'required|string',
            'competition_information' => 'required|string',
            'competition_instance_level' => 'required|string',
            'competition_guide_book' => 'nullable|file|mimes:pdf|max:2048',
            'competition_status' => 'required|in:active,nonactive',
            'competition_fee' => 'required|numeric|gt:0',
            'event_id' => 'required|exists:events,event_id',
        ];
    }
}

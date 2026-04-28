<?php

namespace App\Http\Requests\Admin\Competition;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionRequest extends FormRequest
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
            'slug' => 'required|alpha_dash|unique:competitions,slug',
            'competition_name' => 'required|string|max:255',
            'competition_end_date' => 'required|date',
            'competition_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_second_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_third_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'competition_description' => 'required|string',
            'competition_information' => 'required|string',
            'competition_instance_level' => 'required|string',
            'competition_guide_book' => 'required|file|mimes:pdf|max:5000',
            'competition_status' => 'required|in:active,nonactive',
            'competition_fee' => 'required|numeric|gt:0',
            'competition_view_template' => 'required|in:mobilelegend,pes,uiux,webdesign',
            'event_id' => 'required|exists:events,event_id',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'event_name' => 'required|string|max:255',
            'event_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_theme' => 'required|string',
            'event_about' => 'required|string',
            'event_description' => 'required|string',
            'event_year' => 'required|digits:4',
            'event_status' => 'required|in:active,nonactive',
        ];
    }
}

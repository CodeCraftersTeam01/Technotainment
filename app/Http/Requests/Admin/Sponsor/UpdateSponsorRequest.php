<?php

namespace App\Http\Requests\Admin\Sponsor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSponsorRequest extends FormRequest
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
            'sponsor_name' => 'required|string|max:255',
            'sponsor_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_id' => 'required|exists:events,event_id',
        ];
    }
}

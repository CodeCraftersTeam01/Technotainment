<?php

namespace App\Http\Requests\Admin\MediaPart;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaPartnerRequest extends FormRequest
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
            'media_partner_name' => 'required|string|max:255',
            'media_partner_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_id' => 'required',
        ];
    }
}

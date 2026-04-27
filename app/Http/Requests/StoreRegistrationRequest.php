<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
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
            'team_name' => 'required|string',
            'team_token' => 'required|string',
            'team_logo' => 'required',
            'team_email' => 'required|string|email',
            'team_contact' => 'required|string',
            'team_instance' => 'in:YES,NO',
            'team_instance_name' => 'nullable|string',
            'slug' => 'required|exists:competitions,slug',
            'team_invoice' => 'required|string',

            // Validasi anggota tim
            'members' => 'required|array|size:6',

            // Ketua (index 0) wajib
            'members.0.name' => 'required|string|max:255',
            'members.0.identity' => 'required|string',

            // Anggota 1–4 wajib
            'members.1.name' => 'required|string|max:255',
            'members.1.identity' => 'required|string',
            'members.2.name' => 'required|string|max:255',
            'members.2.identity' => 'required|string',
            'members.3.name' => 'required|string|max:255',
            'members.3.identity' => 'required|string',
            'members.4.name' => 'required|string|max:255',
            'members.4.identity' => 'required|string',

            // Cadangan (index 5) opsional
            'members.5.name' => 'nullable|string|max:255',
            'members.5.identity' => 'nullable|string',
        ];
    }
}

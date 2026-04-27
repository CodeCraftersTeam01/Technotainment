<?php

namespace App\Http\Requests\Admin\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
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
            'announcement_title' => 'required|string|max:255',
            'announcement_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'announcement_description' => 'required|string',
            'delete_photo_status' => 'nullable|in:a8Zx9BdL1mP0QwE',
            'event_id' => 'required|exists:events,event_id',
        ];
    }
}

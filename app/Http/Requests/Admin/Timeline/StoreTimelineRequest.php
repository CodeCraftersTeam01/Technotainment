<?php

namespace App\Http\Requests\Admin\Timeline;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimelineRequest extends FormRequest
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
            'timeline_name' => 'required|string|max:255',
            'timeline_description' => 'required|string',
            'timeline_start' => 'required|date',
            'timeline_end' => 'nullable|date|after_or_equal:timeline_start',
            'competition_id' => 'required|exists:competitions,competition_id',
        ];
    }
}

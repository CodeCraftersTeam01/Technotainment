<?php

namespace App\Http\Requests\Admin\Achievement;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchievementRequest extends FormRequest
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
            'achievement_name' => 'required|string|max:255',
            'achievement_price' => 'required|numeric|gt:0',
            'achievement_description' => 'required|string',
            'competition_id' => 'required|exists:competitions,competition_id',
        ];
    }
}

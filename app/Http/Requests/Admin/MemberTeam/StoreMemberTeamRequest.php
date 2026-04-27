<?php

namespace App\Http\Requests\Admin\MemberTeam;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberTeamRequest extends FormRequest
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
            'member_team_name' => 'required|string|max:255',
            'member_team_identity' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:5120',
            'member_team_role' => 'required|in:Leader,Member,Backup',
            'team_id' => 'required|exists:teams,team_id',
        ];
    }
}

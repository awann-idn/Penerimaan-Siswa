<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicantRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $applicant = $this->route('applicant');
        $applicantId = $applicant ? $applicant->id : null;

        return [
            'nisn' => 'required|string|max:20|unique:applicants,nisn,' . $applicantId,
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'previous_school' => 'required|string|max:255',
            'status' => 'sometimes|in:pending,verified,accepted,rejected',
        ];
    }
}

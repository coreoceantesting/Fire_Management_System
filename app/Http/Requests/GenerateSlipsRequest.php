<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateSlipsRequest extends FormRequest
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
            'datetime' => 'required',
            'caller_name' => 'required|alpha',
            'caller_mobile_no' => 'required|min:10|max:10',
            'incident_location' => 'required',
            'landmark' => 'required',
            'incident_reason' => 'required'
        ];
    }
}

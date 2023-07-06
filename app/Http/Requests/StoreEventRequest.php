<?php

namespace App\Http\Requests;

use App\Rules\ValidateEventEndDateRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'event_title' => 'required|string|min:1',
            'event_start_date' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'before:event_end_date'
                ],
            'event_end_date' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after:event_start_date',
                new ValidateEventEndDateRule,
            ],
            'organization_id' => 'required|exists:users,id'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    public const INQUIRY_TYPES = [
        'general' => 'General inquiry',
        'customer' => 'Customer inquiry',
        'supplier' => 'Supplier inquiry',
        'careers' => 'Careers inquiry',
        'media' => 'Media inquiry',
    ];

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:2', 'max:120'],
            'company_name' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'string', 'email:rfc', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40', 'regex:/^[0-9+()\-\s.]{6,40}$/'],
            'country' => ['required', 'string', 'max:80'],
            'inquiry_type' => ['required', Rule::in(array_keys(self::INQUIRY_TYPES))],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'consent' => ['accepted'],
            // Honeypot: real visitors never see or fill this field.
            'website' => ['nullable', 'max:0'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'full_name' => 'full name',
            'inquiry_type' => 'inquiry type',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid phone number.',
            'consent.accepted' => 'Please confirm that we may use your details to respond to your inquiry.',
        ];
    }
}

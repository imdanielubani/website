<?php

namespace App\Http\Requests;

use App\Rules\HumanSubmissionTime;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BusinessInquiryRequest extends FormRequest
{
    public const INQUIRY_TYPES = [
        'purchase' => 'Purchasing petroleum products',
        'supply' => 'Supplying products or services',
        'partnership' => 'Commercial partnership',
        'logistics' => 'Logistics, storage or terminal services',
        'other' => 'Other business inquiry',
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
            'company_name' => ['required', 'string', 'min:2', 'max:160'],
            'contact_person' => ['required', 'string', 'min:2', 'max:120'],
            'email' => ['required', 'string', 'email:rfc', 'max:190'],
            'phone' => ['required', 'string', 'max:40', 'regex:/^[0-9+()\-\s.]{6,40}$/'],
            'country' => ['required', 'string', 'max:80'],
            'inquiry_type' => ['required', Rule::in(array_keys(self::INQUIRY_TYPES))],
            'product_requirements' => ['nullable', 'string', 'max:1000'],
            'estimated_quantity' => ['nullable', 'string', 'max:120'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            'consent' => ['accepted'],
            // Honeypot: real visitors never see or fill this field.
            'website' => ['nullable', 'max:0'],
            // Time trap: encrypted render timestamp from x-form.consent.
            'form_started' => ['required', 'string', new HumanSubmissionTime],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'contact_person' => __('contact person'),
            'inquiry_type' => __('inquiry type'),
            'product_requirements' => __('product requirements'),
            'estimated_quantity' => __('estimated quantity'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.regex' => __('Please enter a valid phone number.'),
            'consent.accepted' => __('Please confirm that we may use your details to respond to your inquiry.'),
        ];
    }
}

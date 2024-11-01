<?php

namespace App\Http\Requests;

use App\Enums\LabelType;
use Illuminate\Validation\Rule;
use App\Rules\PhoneNumber as Phone;
use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            // Basic contact information
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'about' => 'nullable|string|max:10000',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:10240',
            'color' => 'nullable|string',
            // Birthday
            'birthday.day' => 'nullable|required_with:birthday.month|integer|between:1,31',
            'birthday.month' => 'nullable|required_with:birthday.day|integer|between:1,12',
            'birthday.year' => 'nullable|integer|min:1900',
            // Emails
            'emails' => 'nullable|array',
            'emails.*.email' => 'nullable|email|max:255',
            'emails.*.label' => ['nullable', Rule::in(array_column(LabelType::cases(), 'value'))],
            // Phone numbers
            'phone_numbers' => 'nullable|array',
            'phone_numbers.*.dial_code' => 'nullable|exists:countries,dial_code',
            'phone_numbers.*.phone_number' => ['nullable', 'string', 'max:50', new Phone],
            'phone_numbers.*.label' => ['nullable', Rule::in(array_column(LabelType::cases(), 'value'))],
            // Addresses
            'addresses' => 'nullable|array',
            'addresses.*.country_id' => 'nullable|exists:countries,id',
            'addresses.*.city' => 'nullable|string|max:255',
            'addresses.*.street' => 'nullable|string|max:255',
            'addresses.*.building_number' => 'nullable|string|max:50',
            'addresses.*.apartment_number' => 'nullable|string|max:50',
            'addresses.*.label' => ['nullable', Rule::in(array_column(LabelType::cases(), 'value'))],
            // Companies
            'companies' => 'nullable|array',
            'companies.*.name' => 'nullable|string|max:50',
            // Job titles within companies
            'companies.*.job_names' => 'nullable|array',
            'companies.*.job_names.*.title' => 'nullable|string|max:50',
        ];
    }
}

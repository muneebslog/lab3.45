<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreHmsLabCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:20'],
            'invoice_number' => ['nullable', 'string', 'max:100'],
            'receipt_no' => ['nullable', 'string', 'max:100'],
            'age' => ['nullable', 'integer', 'min:0', 'max:150'],
            'age_unit' => ['nullable', 'string', 'in:Month,Year'],
            'gender' => ['required', 'string', 'in:male,female'],
            'test_codes' => ['required', 'array', 'min:1'],
            // Integers from JSON or numeric strings (HMS / labtests.json style), not short_hand names.
            'test_codes.*' => ['required', 'numeric'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator): void {
            $invoice = $this->input('invoice_number');
            $receipt = $this->input('receipt_no');
            if (! filled($invoice) && ! filled($receipt)) {
                $validator->errors()->add(
                    'invoice_number',
                    'Either invoice_number or receipt_no is required.'
                );
            }
        });
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('test_codes') && is_array($this->input('test_codes'))) {
            $this->merge([
                'test_codes' => array_values(array_filter(
                    array_map(function ($c) {
                        if ($c === null || $c === '') {
                            return null;
                        }
                        if (is_string($c)) {
                            $c = trim($c);
                        }

                        return is_numeric($c) ? 0 + $c : $c;
                    }, $this->input('test_codes')),
                    fn ($c) => $c !== null && $c !== ''
                )),
            ]);
        }
    }
}

<?php

namespace App\Http\Requests\Voucher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherRequest extends FormRequest
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
            'code' => 'required:voucher',
            'usageLimit' => 'required|numeric|min:1',
            'discountPercentage' => 'nullable|numeric|min:0|max:100|exclusive_discount:discountAmount',
            'discountAmount' => 'nullable|numeric|min:0|exclusive_discount:discountPercentage',

            'validFrom' => 'required|date',
            'validTo' => 'required|date|after:validFrom',
        ];
    }
}

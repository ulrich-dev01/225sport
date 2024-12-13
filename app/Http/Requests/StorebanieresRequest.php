<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorebanieresRequest extends FormRequest
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
            'lien1' => 'required|string|max:255',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lien2' => 'nullable|string|max:255',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'lien3' => 'nullable|string|max:255',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
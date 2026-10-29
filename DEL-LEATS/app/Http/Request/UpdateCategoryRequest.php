<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    /**
     * 
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $kategori = $this->route('category');

        return [
            'kode_kategori' => [
                'required',
                'string',
                'max:10',
                Rule::unique('kategoris', 'kode_kategori')->ignore($kategori),
            ],
            'nama_kategori' => ['required', 'string', 'max:100'],
        ];
    }
}

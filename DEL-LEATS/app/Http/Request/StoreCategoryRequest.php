<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriRequest extends FormRequest
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
        return [
            'kode_kategori' => ['required', 'string', 'max:10', 'unique:kategoris,kode_kategori'],
            'nama_kategori' => ['required', 'string', 'max:100'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAlternatifRequest extends FormRequest
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
            "kode" => "required|exists:alternatifs,kode",
        ];
    }

    public function messages(): array
    {
        return [
            "kode.required" => "Kode Alternatif tidak boleh kosong !",
            "kode.exists" => "Kode Alternatif tidak ditemukan !",
        ];
    }
}

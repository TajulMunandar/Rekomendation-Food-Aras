<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahAlternatifRequest extends FormRequest
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
            "kode"=> "required|unique:alternatifs,kode",
            "nama"=> "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "kode.required"=> "Kode Alternatif tidak boleh kosong",
            "kode.unique"=> "Kode Alternatif sudah ada",
            "nama.required"=> "Nama Alternatif tidak boleh kosong",
        ];
    }
}

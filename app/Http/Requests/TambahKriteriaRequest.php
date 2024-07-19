<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahKriteriaRequest extends FormRequest
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
            "kode_kriteria"=> "required",
            "nama_kriteria"=> "required",
            "bobot"=> "required|numeric|between:0,1",
            "atribut"=> "required",
        ];
    }

    public function messages(): array
    {
        return [
            "kode_kriteria.required"=> "Kode Kriteria tidak boleh kosong !",
            "nama_kriteria.required"=> "Nama Kriteria tidak boleh kosong !",
            "bobot.required"=> "Bobot tidak boleh kosong !",
            "bobot.between"=> "Bobot harus diantara 0 sampai 1 !",
            "bobot.numeric"=> "Bobot harus berupa angka !",
            "atribut.required"=> "Atribut tidak boleh kosong !",
        ];
    }
}

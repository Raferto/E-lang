<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarang extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'harga_awal' => 'required|numeric|gt:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required',
            'lelang_start' => 'required|after:now',
            'lelang_finished' => 'required|after:lelang_start',
        ];
    }
}

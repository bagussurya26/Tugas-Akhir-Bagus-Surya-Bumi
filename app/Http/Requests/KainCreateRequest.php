<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KainCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_kain' => 'required',
            'kategori_kains_id' => 'required',
            'raks_id' => 'required',
            'jenis_kain' => 'required',
            'foto' => 'image|file|max:1024|mimes:jpeg,png,jpg',
            'warna' => 'required'
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'kode_kain' => 'Kode Kain',
    //         'kategori_kains_id' => 'Kategori Kain',
    //         'raks_id' => 'Lokasi Rak',
    //         'jenis_kain' => 'Jenis Kain',
    //         'foto' => 'Foto',
    //         'warna' => 'Warna'
    //     ];
    // }

    public function messages()
    {
        return [
            'kode_kain.required' => 'Kode Kain wajib diisi',
            'kategori_kains_id.required' => 'Kategori Kain wajib diisi!',
            'raks_id.required' => 'Lokasi Rak wajib diisi!',
            'jenis_kain.required' => 'Jenis Kain wajib diisi!',
            'foto' => 'Foto',
            'warna.required' => 'Warna wajib diisi!'
        ];
    }
}

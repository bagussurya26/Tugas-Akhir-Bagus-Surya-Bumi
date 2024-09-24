<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdukCreateRequest extends FormRequest
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
            'kode_pakaian' => 'required',
            'kategori_pakaians_id' => 'required',
            'raks_id' => 'required',
            'nama' => 'required',
            'tipe_fit' => 'required',
            'tipe_lengan' => 'required',
            'foto' => 'image|file|max:1024|mimes:jpeg,png,jpg'
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'id' => 'Kode Produk',
    //         'kategori_pakaians_id' => 'Kategori Produk',
    //         'raks_id' => 'Lokasi Rak',
    //         'nama' => 'Nama Produk',
    //         'tipe_fit' => 'Tipe Body Fit',
    //         'tipe_lengan' => 'Tipe Lengan',
    //         'foto' => 'Foto'
    //     ];
    // }

    public function messages()
    {
        return [
            'kode_pakaian.required' => 'Kode Produk wajib diisi',
            'kategori_pakaians_id.required' => 'Kategori Produk wajib diisi',
            'raks_id.required' => 'Lokasi Rak wajib diisi',
            'nama.required' => 'Nama Produk wajib diisi',
            'tipe_fit.required' => 'Tipe Body Fit wajib diisi',
            'tipe_lengan.required' => 'Tipe Lengan wajib diisi',
            'foto.mimes' => 'Hanya menerima spesifikasi image'
        ];
    }
}

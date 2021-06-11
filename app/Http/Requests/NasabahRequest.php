<?php

namespace App\Http\Requests;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class NasabahRequest extends FormRequest
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
            'nama'            => 'required',
            'alamat'          => 'required',
            'jenis_kelamin'   => 'required',
            'no_hp'           => 'required|numeric',
            'image'           => 'image|image|max:5000',
            'jumlah_pinjaman' => 'numeric',
            'jumlah_tabungan' => 'numeric'
        ];

        
    }
}

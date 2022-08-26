<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationCommandeFormRequest extends FormRequest
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
            'nom'=> 'required',
            'prenom'=> 'required|min:3',
            'email'=> 'required|email',
            'telephone'=> 'required|min:8|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'pays'=> 'required',
            'rue'=> 'required|min:4',
            'ville'=> 'required|min:3',
            'code_postal'=> 'required',

        ];
    }
}

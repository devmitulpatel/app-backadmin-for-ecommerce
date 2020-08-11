<?php

namespace App\Http\Requests\Settings\Product;

use Illuminate\Foundation\Http\FormRequest;

class SaveFields extends FormRequest
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
            'name'=>'required|unique:extra__fields',
            'dname'=>'required',
            //'cat'=>'required',
          //  'scat'=>'required',
            'type'=>'required',
            'dvalue'=>'required',
            'required'=>'required',
            'status'=>'required',
        ];
    }
}

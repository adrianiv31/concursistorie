<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class IndrumatorEditRequest extends Request
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
            //
            'name' => 'required|max:255',


            //   'judete_id'=>'required',
            'localitati_id' => 'required',
            'section_id' => 'required',
            'grade_id' => 'required',
            'password' => 'confirmed',

        ];
    }
}

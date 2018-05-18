<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EvalRequest extends Request
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

        foreach($this->request->get('s2') as $key => $val) {
            $rules['rasII.'.$val] = 'required';

        }
        foreach($this->request->get('s3') as $key => $val) {
            $rules['rasIII.'.$val] = 'required';

        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests;

class ApplyRefundRequest extends Request
{

    public function rules()
    {
        return [
            'reason' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'reason.required' => '原因不能为空',
        ];
    }

}

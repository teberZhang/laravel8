<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Log;

class CommonRequest extends FormRequest{

    protected function failedValidation(Validator $validator){

        $error= $validator->errors()->all();
        throw new HttpResponseException(response()->json(['code'=>422,'message'=>$error[0]]));
    }

    /**
     *  配置验证器实例。
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->getMessageBag()->count()) {
                Log::error('参数校验' . json_encode($validator->errors(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        });
    }
}

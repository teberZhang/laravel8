<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dingo\Api\Routing\Helpers;

class AuthController extends Controller
{
    use Helpers;
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        //return api_route('api.v1.test');
        return $this->response->array(['code' => 200, 'token' => $data]);
//        if (!($token = auth('api')->attempt($data))) {
//            return $this->transFormer(40000, 'email or password error');
//        }
//        return $this->response->array(['code' => 200, 'token' => $token]);
    }
}

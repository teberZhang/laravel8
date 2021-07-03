<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tymon\JWTAuth\JWTAuth;

class UserController extends Controller
{
    protected $jwt;
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required',
        ]);
        try {
            //验证用户是否存在，存在则颁发token，不存在，则不颁发token。
            if (! $token = $this->jwt->attempt($request->only('email', 'password'))) {

                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }

        return JsonResponse::create([
            'success'=>'200',
            'msg'=>'ok',
            'data'=>[
                'user'=>Auth::user(),
                'token'=>$token
            ]
        ]);
    }

    /*测试方法*/
    public function decode(Request $request){

        return JsonResponse::create([
            'success'=>'200',
            'msg'=>'ok',
            'data'=>[
                'user'=>Auth::user(),
            ]
        ]);
    }

}

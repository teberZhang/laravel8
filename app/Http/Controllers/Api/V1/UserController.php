<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Tymon\JWTAuth\JWTAuth;

class UserController extends BaseController
{
    protected $jwt;
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function login(UserLoginRequest $userLoginRequest)
    {
        try {
            //验证用户是否存在，存在则颁发token，不存在，则不颁发token。
            if (! $token = $this->jwt->attempt($userLoginRequest->only('email', 'password'))) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        } catch (\Tymon\JWTAuth\Exceptions\InvalidClaimException $e) {
            return response()->json(['token_invalid' => $e->getMessage()], 500);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['token_user' => $e->getMessage()], 500);
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

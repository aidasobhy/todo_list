<?php

namespace App\Http\Controllers\Api;

use App\Requests\Users\CreateUserValidator;
use App\Requests\Users\LoginUserValidator;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
    public  $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

   public function login(LoginUserValidator $loginUserValidator)
   {
       if (!empty($loginUserValidator->getErrors())){
           return response()->json($loginUserValidator->getErrors(),'406');
       }
       $request=$loginUserValidator->getRequest();
       if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
           $user=Auth::user();
           $success['token']=$user->createToken('MyApp')->plainTextToken;
           $success['name']=$user->name;

           return $this->sendResponse($success,'User Login Successfully');
       }else
       {
           return $this->sendResponse('Unauthorized','fail',401);
       }
   }


}

<?php

namespace App\Http\Controllers\Api;

use App\Requests\Users\CreateUserValidator;
use App\Requests\Users\LoginUserValidator;
use App\Services\UserService;

class RegisterController extends BaseController
{
    public  $userService;
    public function __construct(UserService $userService)
    {
        $this->userService=$userService;
    }

    public function register(CreateUserValidator $createUserValidator)
    {
             if (!empty($createUserValidator->getErrors())){
                 return response()->json($createUserValidator->getErrors(),'406');
             }

             $user=$this->userService->createUser($createUserValidator->getRequest()->all());
             $message['user']=$user;
             $message['token']=$user->createToken('MyApp')->plainTextToken;
            return $this->sendResponse($message);
    }


}

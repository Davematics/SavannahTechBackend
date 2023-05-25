<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\Auth\AuthServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected AuthServices $authServices;
    public function __construct(AuthServices $authServices)
    {
        $this->authServices = $authServices;
    }

    public function UserRegistration(RegistrationRequest $request)
    {
        $user = $this->authServices->userRegistration($request);
 
        return $this->success('You have successfully registered your Account.', $user, Response::HTTP_CREATED);
    }

   
    public function login(LoginRequest $request)
    {
       

        $login = $this->authServices->login($request);

        if (!$login) {
            return $this->failure('Invalid username or password', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return $this->success('User logged in successfully', $login, Response::HTTP_OK);
    }

    public function logout()
    {
       
        $logout = $this->authServices->logout();

        return $this->success('User successfully signed out', $logout);
     
    }

    

    
}

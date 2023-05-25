<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\SendMail;

class AuthServices
{
    public function userRegistration($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // $token = $user->createToken('auth_token')->plainTextToken;
        // $user->access_token = $token;

        return $user;
    }

    public function login($request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return false;
        }
        $user = auth()->user();

        //create new token
        $token = $user->createToken('auth_token')->plainTextToken;
        $user->access_token = $token;

        return $user;
    }


    public function logout()
{
    $user = User::where('id', auth()->user()->id)->firstOrFail();
    $user->tokens()->delete();

    return  $user;
}
}

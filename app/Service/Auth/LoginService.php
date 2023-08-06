<?php

namespace App\Service\Auth;

use App\Data\Auth\LoginData;
use App\Data\Auth\ResponseLoginData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function __construct(
    ){}
    
    
    public function handle(Request $request, LoginData $loginData, string $guard = 'api-company'): ?ResponseLoginData
    {
        $credentials = $loginData->only('email', 'password')->toArray();
        
        if (!Auth::guard($guard)->attempt($credentials, $loginData->remember)) {
            return null;
        }

        $company = $request->user();
        $token = $company->createToken($company->email)->accessToken;

        return ResponseLoginData::from($company, $token);
    }

    
}

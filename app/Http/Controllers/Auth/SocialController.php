<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Illuminate\Http\{Request, Response};
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialUser;

class SocialController extends ApiController
{
    use AuthenticatesUsers;

    // 소셜로그인

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    //소셜에서 인증을 받은 후 응답
    protected function handleProviderCallback(Request $request, $provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();
        dd($socialUser);
        $user = User::where('uid', $socialUser->id)->where('join_from', $provider)->first();

        if($user){
            $user = User::find($user->uid);

            $token = $user->createToken($provider)->accessToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        }else{
            $user = User::create([
                'uid' => $socialUser->getId(),
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
                'join_from' => $provider
            ]);

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } 
    }
}

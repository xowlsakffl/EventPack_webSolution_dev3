<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\UserActionLog;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ThrottlesLogins;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'uid';
    }

    public function login(Request $request)
    {
        //유효성 검사
        $validator = Validator::make($request->all(), [
            'uid' => ['required'],
            'password' => ['required']
        ],
        [
            'uid.required' => '아이디를 입력해주세요.',
            'password.required' => '비밀번호를 입력해주세요.',
        ]);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $this->incrementLoginAttempts($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }else{
            return $this->ApiResponse('danger', getMSG('user.notexist'), null, 400);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request)
        );
    }

    protected function sendLoginResponse(Request $request)
    {   
        $tokenResult = auth()->user()->createToken('authToken');    
        $token = $tokenResult->token;

        if($request->remember)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        $this->clearLoginAttempts($request);

        auth()->user()->userActionLogs()->create([
            'action' => 'login',
            'content' => 'login',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT'],
        ]);

        return $this->ApiResponse('stable', ['로그인되었습니다.', 'Login success.'], ['user' => auth()->user(), 'access_token' => $tokenResult->accessToken], 200);
    }

    public function logout(Request $request)
    {      
        $request->user()->tokens->each(function ($token, $key) {
            $this->revokeAccessAndRefreshTokens($token->id);
        });

        auth()->user()->userActionLogs()->create([
            'udx' => auth()->user()->udx,
            'action' => 'logout',
            'content' => 'logout',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT'],
        ]);

        return $this->ApiResponse('stable', ['로그아웃 되었습니다.', 'Logout success.'], null, 200);
    }

    protected function revokeAccessAndRefreshTokens($tokenId) {
        $tokenRepository = app('Laravel\Passport\TokenRepository');
        $refreshTokenRepository = app('Laravel\Passport\RefreshTokenRepository');
    
        $tokenRepository->revokeAccessToken($tokenId);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($tokenId);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        return $this->ApiResponse('danger', ['5회 이상 틀렸습니다.', 'error.'], ['seconds' => $seconds, 'minutes' => ceil($seconds / 60),], 400);
    }
}

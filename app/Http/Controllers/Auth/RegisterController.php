<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Rules\UserId;
use App\User;
use App\UserActionLog;

class RegisterController extends ApiController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'uid' => $data['uid'],
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            // 'cell' => $data['cell'],
            // 'tel' => $data['tel'],
        ]);
    }

    //점검 후 가입처리
    public function register(Request $request)
    {
        $rule = [
            'uid' => ['required', new UserId, 'min:4', 'max:32', 'unique:users'],
            'password' => ['required', 'min:4', 'confirmed'],
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'cell' => ['required', 'max:20'],
            'tel' => ['max:20'],
            'country' => ['required']
        ];

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $user = $this->create($request->all());

        //$accessToken = $user->createToken('authToken')->accessToken;

        return $this->ApiResponse('stable', ['가입되었습니다.', 'Signup success'], ['user' => $user], 200);
    }
}

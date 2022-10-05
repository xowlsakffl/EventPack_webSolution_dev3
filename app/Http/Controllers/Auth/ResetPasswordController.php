<?php

namespace App\Http\Controllers\Auth;

use App\EmailCheck;
use App\Http\Controllers\ApiController;
use App\PasswordReset;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends ApiController
{
    public function reset(Request $request)
    {
        //유효성 검사
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'min:4', 'confirmed'],
        ],
        [
            'password.required' => '비밀번호를 입력해주세요.',
            'password.min' => '최소 4자이상 입력해주세요.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
        ]);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }
        
        if($request->token !== NULL){
            $token = $request->token;
        }else{
            return $this->ApiResponse('danger', getMSG(403), null, 403);
        }
        
        if(!$passwordResets = PasswordReset::where('token', $token)->first()){
            return $this->ApiResponse('danger', getMSG(403), null, 403);
        }

        if(!$user = User::where('email', $passwordResets->email)->first()){
            return $this->ApiResponse('danger', getMSG(400), null, 400);
        }
        
        try {
            $user->password = Hash::make($request->password);
            $user->save();

            EmailCheck::where('token', $token)->where('type', EmailCheck::PW)->delete();
            $passwordResets->delete();

            return $this->ApiResponse('stable', ['비밀번호가 변경되었습니다.', 'Your password has been changed.'], null, 200);

        } catch (\Exception $exception) {
            return $this->ApiResponse('danger', $exception->getMessage(), null, 400);
        }

        
    }
}

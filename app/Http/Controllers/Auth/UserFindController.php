<?php

namespace App\Http\Controllers\Auth;

use App\EmailCheck;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserFindController extends ApiController
{
    public function sendUserLinkEmail(Request $request)
    {
        //유효성 검사
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:50']
        ],
        [
            'email.required' => '이메일을 입력해주세요.',
            'email.string' => '문자만 입력가능합니다.',
            'email.email' => '이메일 형식이 올바르지 않습니다.',
            'email.max' => '최대 50자까지 입력가능합니다.',
        ]);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $user = User::where('email', $request->email)->first();
        if(!$user == NULL){
        
            //이메일 체크 테이블 저장
            $data = EmailCheck::create([
                'type' => EmailCheck::ID,
                'email' => $request->email,
                'check_number' => str_pad(mt_rand(0,999999),6,'0'),
                'token' => Str::random(60),
            ]);
            
            //현재 보낸 시간보다 오래된거는 삭제
            EmailCheck::where('email', $data->email)->where('created_at', '<', $data->created_at)->where('type', EmailCheck::ID)->delete();

            //메일 발송
            Mail::send('email-num', ['data' => $data['check_number']], function ($message) use ($data, $user) {
                $message->to($user->email);
                $message->subject('인증번호는'.$data['check_number']);
            });

        }else{
            return $this->ApiResponse('danger', getMSG('user.notexist'), null, 400);
        }
        
        return $this->ApiResponse('stable', ['메일이 발송되었습니다.', 'A mail has been sent.'], ['email' => $data->email], 200);
    }

    public function emailCheckNumber(Request $request)
    {
        //유효성 검사
        $validator = Validator::make($request->all(), [
            'check_number' => 'required|numeric',
        ],
        [
            'check_number.required' => '인증번호를 입력해주세요.',
            'check_number.numeric' => '숫자만 입력가능합니다.',
        ]);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $check_number = $request->check_number;
        $DB_Data = EmailCheck::where('email', $request->email)->where('type', EmailCheck::ID)->latest('created_at')->first(); 

        //이메일이 없다면
        if($DB_Data === NULL){
            return $this->ApiResponse('danger', getMSG(400), null, 400);
        }

        //토큰값 존재여부
        if($DB_Data->token !== NULL){
            $token = $DB_Data->token;  
        }else{
            return $this->ApiResponse('danger', getMSG(403), null, 403);
        }
        //인증번호가 일치한다면
        if($DB_Data->check_number !== $check_number){           
            return $this->ApiResponse('danger', ['인증번호가 일치하지 않습니다.', 'The verification code does not match.'], null, 400); 
        }

        if($DB_Data->deleted_at !== NULL){
            return $this->ApiResponse('danger', getMSG(403), null, 403);
        }
        else if($DB_Data->created_at < Carbon::now()->subMinutes(5)->toDateTimeString()){
            return $this->ApiResponse('danger', getMSG(408), null, 408);
        }
        
        try {

            //인증 성공하면 해당 이메일 인증번호 컬럼 전부 삭제
            EmailCheck::where('token', $DB_Data->token)->where('type', EmailCheck::ID)->delete();
            $user = User::where('email', $DB_Data->email)->first();

            return $this->ApiResponse('stable', ['인증되었습니다.', 'Certified.'], ['user' => $user,], 200);
    
        } catch (\Exception $exception) {
            return $this->ApiResponse('danger', $exception->getMessage(), null, 400);
        }   
    }
}

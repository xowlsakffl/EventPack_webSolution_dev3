<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\UserPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function show()
    {
        $user = auth('api')->user();
        return response()->json([
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $rule = [
            'password' => ['required', 'min:4', 'confirmed'],
            'name' => ['required', 'string', 'max:20'],
            'cell' => ['required', 'max:20', new UserPhone],
            'tel' => ['max:20', new UserPhone],
            'country' => ['required']
        ];

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        //수정
        $user = auth('api')->user();

        if($user === NULL){
            return $this->ApiResponse('danger', getMSG(400), null, 400);
        }

        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->cell = $request->cell;
        $user->tel = $request->tel;
        $user->country = $request->country;
        $user->save();

        return $this->ApiResponse('stable', ['수정되었습니다.', 'Modified.'], ['user' => $user], 200);
    }
}

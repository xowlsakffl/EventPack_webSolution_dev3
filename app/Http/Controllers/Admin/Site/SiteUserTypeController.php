<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use App\SiteUserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteUserTypeController extends ApiController
{
    public function index($sdx){
        $userSite = auth('api')->user()->sites();
        $userSite = $userSite->findOrFail($sdx);

        $typeData = SiteUserType::where('sdx', $userSite->sdx)->get();

        return $this->ApiResponse('stable', null, ['SiteUserType' => $typeData], 200);
    }

    public function store(Request $request, $sdx){
        $rule = [
            'name' => ['required', 'string', 'max:20'],
            'explain' => ['max:100'],
        ];

        $messages = [
            'name.required' => '분류명을 입력해주세요.',
            'name.string' => '문자만 입력해주세요.',
            'name.max' => '최대 20자까지 입력가능합니다.',
            'explain.max' => '최대 100자까지 입력가능합니다.',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userSite = auth('api')->user()->sites();
        $userSite = $userSite->findOrFail($sdx);

        $typeData = $userSite->siteUserTypes()->create([
            'sdx' => $sdx,
            'name' => $request->name,
            'explain' => $request->explain
        ]);

        return $this->ApiResponse('stable', ['분류가 생성되었습니다.', 'success'], ['typeData' => $typeData], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SiteLayoutSetController extends ApiController
{
    public function show($sdx)
    {
        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $siteLayoutSet = $userWork->siteLayoutSets()->get();

        return $this->ApiResponse('stable', null, ['siteLayoutSet' => $siteLayoutSet], 200);
    }

    public function update(Request $request, $sdx)
    {
        $rule = [
            'use_site_menu' => ['boolean'],
            'display_type' => ['in:direct, fadeIn, slideDown'],
            'display_duration' => ['max:4'],
            'font_default' => ['max:200'],
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $userWork->siteLayoutSets()->update($data);

        return $this->ApiResponse('stable', ['웹사이트 설정이 수정되었습니다.', 'Website config is modified.'], null, 200);
    }
}

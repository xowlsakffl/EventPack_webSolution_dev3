<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteNavigationController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($sdx)
    {
        $userSite = auth('api')->user()->sites();
        $userSite = $userSite->findOrFail($sdx);

        $siteNavis = $userSite->siteNavigations()->get();

        return $this->ApiResponse('stable', null, ['siteNavis' => $siteNavis], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $sdx)
    {
        $rule = [
            'sequence' => ['regex:/^[A-Z]+$/', 'max:2'],
            'name' => ['max:100'],
            'new_window' => ['boolean'],
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $userWork->siteNavigations()->create($data);

        return $this->ApiResponse('stable', ['메뉴가 추가되었습니다.', 'Menu is created.'], null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sdx, $sndx)
    {
        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $siteNavi = $userWork->siteNavigations()->findOrFail($sndx);

        return $this->ApiResponse('stable', null, ['siteNavi' => $siteNavi], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sdx, $sndx)
    {
        $rule = [
            'sequence' => ['regex:/^[A-Z]+$/', 'max:2'],
            'name' => ['max:100'],
            'new_window' => ['boolean'],
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $userWork->siteNavigations()->findOrFail($sndx)->update($data);

        return $this->ApiResponse('stable', ['메뉴가 수정되었습니다.', 'Menu is modified.'], null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sdx, $sndx)
    {
        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $userWork->siteNavigations()->findOrFail($sndx)->delete();

        return $this->ApiResponse('stable', ['메뉴가 삭제되었습니다.', 'Menu is deleted.'], null, 200);
    }
}

<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteTaskController extends ApiController
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

        $siteTasks = $userSite->siteTasks()->get();

        return $this->ApiResponse('stable', null, ['siteTasks' => $siteTasks], 200);
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
            'language' => ['in:kor,eng'],
            'sequence' => ['regex:/^[A-Z]+$/', 'max:2'],
            'name' => ['max:100'],
            'use_layout' => ['boolean'],
            'rewrite' => ['max:255']
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        $siteNavi = $userWork->siteNavigations()->findOrFail($request->sndx);

        $siteTask = $userWork->siteTasks()->create([
            'language' => $request->language,
            'sndx' => $siteNavi->sndx,
            'parent' => $request->parent,
            'sequence' => $request->sequence,
            'name' => $request->name,
            'use_layout' => $request->use_layout,
            'rewrite' => $request->rewrite,
        ]);
        
        $siteTask->update([
            'rstdx' => $siteTask->stdx
        ]);

        return $this->ApiResponse('stable', ['기능이 추가되었습니다.', 'created.'], null, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sdx, $stdx)
    {
        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $siteTask = $userWork->siteTasks()->findOrFail($stdx);

        return $this->ApiResponse('stable', null, ['siteTask' => $siteTask], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sdx, $stdx)
    {
        $rule = [
            'language' => ['in:kor,eng'],
            'sequence' => ['regex:/^[A-Z]+$/', 'max:2'],
            'name' => ['max:100'],
            'use_layout' => ['boolean'],
            'rewrite' => ['max:255']
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule, $messages);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        $siteNavi = $userWork->siteNavigations()->findOrFail($request->sndx);

        $userWork->siteTasks()->findOrFail($stdx)->update([
            'rstdx' => $request->rstdx,
            'language' => $request->language,
            'sndx' => $siteNavi->sndx,
            'parent' => $request->parent,
            'sequence' => $request->sequence,
            'name' => $request->name,
            'use_layout' => $request->use_layout,
            'rewrite' => $request->rewrite,
        ]);

        return $this->ApiResponse('stable', ['기능이 수정되었습니다.', 'modified.'], null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sdx, $stdx)
    {
        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        $userWork->siteTasks()->findOrFail($stdx)->delete();

        return $this->ApiResponse('stable', ['기능이 삭제되었습니다.', 'deleted.'], null, 200);
    }
}

<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use App\SiteUserCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteUserConditionController extends ApiController
{
    public function index($sdx){
        $userSite = auth('api')->user()->sites();
        $userSite = $userSite->findOrFail($sdx);

        $conditionData = SiteUserCondition::where('sdx', $userSite->sdx)->get();

        return $this->ApiResponse('stable', null, ['SiteUserType' => $conditionData], 200);
    }

    public function store(Request $request, $sdx){
        $rule = [
            'name' => ['required', 'string', 'max:20'],
            'explain' => ['max:100'],
        ];

        $validator = Validator::make($request->all(), $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userSite = auth('api')->user()->sites();
        $userSite = $userSite->findOrFail($sdx);

        $conditionData = SiteUserCondition::where('sdx', $userSite->sdx)->create([
            'sdx' => $sdx,
            'name' => $request->name,
            'explain' => $request->explain
        ]);

        return $this->ApiResponse('stable', ['자격이 생성되었습니다.', 'success'], ['conditionData' => $conditionData], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sdx, $sutdx)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

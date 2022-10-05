<?php

namespace App\Http\Controllers\Admin\Work;

use App\Http\Controllers\ApiController;
use App\Rules\WorkDuration;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WorkController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth('api')->user();
        $siteDatas = $user->works;

        return $this->ApiResponse('stable', null, ['siteDatas' => $siteDatas], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => ['required', 'string', 'max:30'],
            'participant' => ['required', 'max:10'],
            'duration' => ['required', new WorkDuration, 'max:30']
        ];

        $messages = [
            'name.required' => '성명을 입력해주세요.',
            'name.string' => '문자만 입력해주세요.',
            'name.max' => '최대 30자까지 가능합니다.',
            'participant.required' => '참가자 수를 입력해주세요.',
            'participant.max' => '최대 10자까지 입력가능합니다.',
            'duration.required' => '기간을 입력해주세요.', 
            'duration.max' => '최대 30자까지 입력가능합니다.'
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule, $messages);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->works();
        $userWork->create($data);

        return $this->ApiResponse('stable', ['프로젝트가 생성되었습니다.', 'Project is created.'], null, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $wdx)
    {
        $rule = [
            'name' => ['required', 'string', 'max:30'],
            'participant' => ['required', 'max:10'],
            'duration' => ['required', new WorkDuration, 'max:30']
        ];

        $messages = [
            'name.required' => '성명을 입력해주세요.',
            'name.string' => '문자만 입력해주세요.',
            'name.max' => '최대 30자까지 가능합니다.',
            'participant.required' => '참가자 수를 입력해주세요.',
            'participant.max' => '최대 10자까지 입력가능합니다.',
            'duration.required' => '기간을 입력해주세요.', 
            'duration.max' => '최대 30자까지 입력가능합니다.'
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule, $messages);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->works();
        
        $userWork = $userWork->findOrFail($wdx);
        
        $userWork->update($data);

        return $this->ApiResponse('stable', ['프로젝트가 수정되었습니다.', 'Project is modified.'], null, 200);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($wdx)
    {
        $userWork = auth('api')->user()->works();
        
        $userWork = $userWork->findOrFail($wdx);

        $userWork->delete();

        return $this->ApiResponse('stable', ['프로젝트가 삭제되었습니다.', 'Project is deleted.'], null, 200);   
    }
}

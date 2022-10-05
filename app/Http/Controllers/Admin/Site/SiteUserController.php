<?php

namespace App\Http\Controllers\Admin\Site;

use App\Http\Controllers\ApiController;
use App\Site;
use App\SiteUser;
use App\SiteUserCondition;
use App\SiteUserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteUserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userTypeList(Request $request, $sdx)
    {
        $userSite = auth('api')->user()->sites()->findOrFail($sdx);
        $siteUserType = SiteUserType::where('sdx', $userSite->sdx)->get();
        $query = SiteUser::where('sdx', $userSite->sdx);

        $searchOption = $request->search_option;
        $searchText = $request->search_text;
        $type = $request->type;

        if ($request->has('search_text')) { // check for query parameter in Input 
            $query = $query->where(function($query) use ($searchOption, $searchText) { // this will create condition like 'and (`segmentName` LIKE ? or `segmentJson` LIKE ?)'
                $query->orWhere($searchOption, 'LIKE', '%' . $searchText . '%');                    
            });
        }
        
        if($request->has('state')){
            switch ($request->state) {
                case SiteUser::NORMAL:
                    $query = $query->where('state', 10);
                    break;
                case SiteUser::WAITING:
                    $query = $query->where('state', 9);
                    break;
                case SiteUser::STOP:
                    $query = $query->where('state', 8);
                    break;
                case SiteUser::DELETE:
                    $query = $query->where('state', 0);
                    break;
                default:
                    $query;
                    break;
            }
        }

        if($request->has('type')){
            $query = $query->whereHas('siteUserTypes', function($q) use($type){
                return $q->where('sutdx', $type);
            });
        }

        $result = $query->paginate(10);

        return $this->ApiResponse('stable', null, ['siteUser' => $result, 'siteUserType' => $siteUserType], 200);
    }

    public function userConditionList(Request $request, $sdx)
    {
        $userSite = auth('api')->user()->sites()->findOrFail($sdx);
        $siteUserCondition = SiteUserCondition::where('sdx', $userSite->sdx)->get();
        $query = SiteUser::where('sdx', $userSite->sdx);

        $searchOption = $request->search_option;
        $searchText = $request->search_text;
        $type = $request->type;

        if ($request->has('search_text')) { // check for query parameter in Input 
            $query = $query->where(function($query) use ($searchOption, $searchText) { // this will create condition like 'and (`segmentName` LIKE ? or `segmentJson` LIKE ?)'
                $query->orWhere($searchOption, 'LIKE', '%' . $searchText . '%');                    
            });
        }
        
        if($request->has('state')){
            switch ($request->state) {
                case SiteUser::NORMAL:
                    $query = $query->where('state', 10);
                    break;
                case SiteUser::WAITING:
                    $query = $query->where('state', 9);
                    break;
                case SiteUser::STOP:
                    $query = $query->where('state', 8);
                    break;
                case SiteUser::DELETE:
                    $query = $query->where('state', 0);
                    break;
                default:
                    $query;
                    break;
            }
        }

        if($request->has('type')){
            $query = $query->whereHas('siteUserConditions', function($q) use($type){
                return $q->where('sucdx', $type);
            });
        }

        $result = $query->paginate(10);

        return $this->ApiResponse('stable', null, ['siteUser' => $result, 'siteUserCondition' => $siteUserCondition], 200);
    }

    public function userShow($sdx, $sudx)
    {
        $userSite = auth('api')->user()->sites()->findOrFail($sdx);
        $siteUser = SiteUser::where('sdx', $userSite->sdx)->findOrFail($sudx);

        $siteUserType = $siteUser->siteUserTypes;
        $siteUserCondition = $siteUser->siteUserConditions;

        return $this->ApiResponse('stable', null, ['siteUser' => $siteUser], 200);
    }

    public function userUpdate(Request $request, $sdx, $sudx)
    {
        $userSite = auth('api')->user()->sites()->findOrFail($sdx);
        $siteUser = SiteUser::where('sdx', $userSite->sdx)->findOrFail($sudx);

        $rule = [
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'cell' => ['required', 'max:20'],
        ];

        $messages = [
            'name.required' => '성명을 입력해주세요.',
            'name.string' => '문자만 입력해주세요.',
            'name.max' => '최대 20자까지 가능합니다.',
            'email.required' => '이메일을 입력해주세요.',
            'email.string' => '문자만 입력가능합니다.',
            'email.email' => '이메일 형식이 올바르지 않습니다.',
            'email.max' => '최대 50자까지 입력가능합니다.',
            'email.unique' => '이미 존재하는 이메일입니다.',
            'cell.required' => '휴대폰번호를 입력해주세요.',
            'cell.max' => '최대 20자까지 입력가능합니다.',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $siteUser->update($request->all());
        
        $siteUser->siteUserTypes()->detach();
        $siteUser->siteUserTypes()->sync($request->type);

        $siteUser->siteUserConditions()->detach();
        $siteUser->siteUserConditions()->sync($request->condition);
        
        return $this->ApiResponse('stable', ['사용자 정보가 수정되었습니다.', 'user is modified.'], null, 200);
    }
}

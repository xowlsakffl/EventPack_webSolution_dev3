<?php

namespace App\Http\Controllers\Admin\Site;

use App\File;
use App\Http\Controllers\ApiController;
use App\Rules\WorkDuration;
use App\Site;
use App\SiteUserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class SiteController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($wdx)
    {
        $userWork = auth('api')->user()->works()->findOrFail($wdx);

        $siteDataAll = $userWork->sites()->get();
        
        return $this->ApiResponse('stable', null, ['siteDataAll' => $siteDataAll], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $wdx)
    {
        $rule = [
            'name' => ['required', 'string', 'max:30'],
            'domain' => ['unique:sites', 'url'],
            'email_name' => ['max:20', 'string'],
            'email_address' => ['email', 'string'],
            'phone_name' => ['max:20', 'string'],
            'phone_address' => ['max:20', 'string'],
            'title' => ['max:100', 'string'],
            'description' => ['max:200'],
            'keyword' => ['max:200'],
            'favicon_fdx' => ['image', 'max:10240'],
            'og_title' => ['max:100', 'string'],
            'og_url' => ['url', 'string'],
            'og_description' => ['max:200'],
            'og_images' => ['image', 'max:10240'],
            'meta' => ['max:200', 'string'],
            'saving_events_pack' => ['boolean'],
            'use_email_auth' => ['boolean'],
            'main_user_policy' => ['boolean'],
            'seperate_user_policy' => ['boolean'],
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->works()->findOrFail($wdx);
        
        if($request->hasFile('favicon_fdx')){
            $data['favicon_fdx'] = $this->imageUpload(auth('api')->user()->udx, $request->file('favicon_fdx'));    
        }

        if($request->hasFile('og_images')){
            $data['og_images'] = $this->imageUpload(auth('api')->user()->udx, $request->file('og_images'));
        }

        $userWork->sites()->create($data);

        return $this->ApiResponse('stable', ['웹사이트가 생성되었습니다.', 'Website is created.'], null, 200);
    }

    public function show($sdx)
    {
        $userSite = auth('api')->user()->sites()->findOrFail($sdx);

        //favicon
        $favicon = $userSite->siteFavicon()->get();
        //og_image
        $og_image = $userSite->siteOgImage()->get();

        return $this->ApiResponse('stable', null, ['userSite' => $userSite, 'favicon' => $favicon, 'og_image' => $og_image], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sdx)
    {
        $rule = [
            'name' => ['required', 'string', 'max:30'],
            'domain' => ['unique:sites', 'url'],
            'email_name' => ['max:20', 'string'],
            'email_address' => ['email', 'string'],
            'phone_name' => ['max:20', 'string'],
            'phone_address' => ['max:20', 'string'],
            'title' => ['max:100', 'string'],
            'description' => ['max:200'],
            'keyword' => ['max:200'],
            'favicon_fdx' => ['image', 'max:10240'],
            'og_title' => ['max:100', 'string'],
            'og_url' => ['url', 'string'],
            'og_description' => ['max:200'],
            'og_images' => ['image', 'max:10240'],
            'meta' => ['max:200', 'string'],
            'saving_events_pack' => ['boolean'],
            'use_email_auth' => ['boolean'],
            'main_user_policy' => ['boolean'],
            'seperate_user_policy' => ['boolean'],
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return $this->ApiResponse('danger', $validator->errors(), null, 400);
        }

        $userWork = auth('api')->user()->sites()->findOrFail($sdx);
        
        if($request->hasFile('favicon_fdx')){
            $favicon = $userWork->siteFavicon()->first();
            if($favicon){
                $deleteFile = File::find($favicon->fdx);
                Storage::disk('s3')->delete('images/'.$favicon->up_name);
                $deleteFile->delete();

                $data['favicon_fdx'] = $this->imageUpload(auth('api')->user()->udx, $request->file('favicon_fdx'));    
            }else{
                $data['favicon_fdx'] = $this->imageUpload(auth('api')->user()->udx, $request->file('favicon_fdx'));
            }
        }

        if($request->hasFile('og_images')){
            $ogImage = $userWork->siteOgImage()->first();
            if($ogImage){
                $deleteFile = File::find($ogImage->fdx);
                Storage::disk('s3')->delete('images/'.$ogImage->up_name);
                $deleteFile->delete();

                $data['og_images'] = $this->imageUpload(auth('api')->user()->udx, $request->file('og_images'));    
            }else{
                
                $data['og_images'] = $this->imageUpload(auth('api')->user()->udx, $request->file('og_images'));
            }
        }

        $userWork->update($data);

        return $this->ApiResponse('stable', ['웹사이트가 수정되었습니다.', 'Website is modified.'], null, 200);
    }

    private function imageUpload($udx, $image){
        //$image->getClientOriginalName(); 파일명
        //$image->getClientSize(); 파일사이즈
        //$image->getClientOriginalExtension(); 확장자
        //$image->getClientOriginalName();
        
        $imageinfo = getimagesize($image);
        $width = $imageinfo[0];
        $height = $imageinfo[1];
        $imageName = time().$image->getFilename().".".$image->getClientOriginalExtension();
        $imagePath = 'images/'.$imageName;
        Storage::disk('s3')->put($imagePath, file_get_contents($image), 'public');
        
        $file = File::create([
            'udx' => $udx,
            'url' => Storage::disk('s3')->url($imagePath),
            'up_name' => $imageName,
            'real_name' => $image->getClientOriginalName(),
            'size' => $image->getClientSize(),
            'extension' => $image->getClientOriginalExtension(),
            'width' => $width,
            'height' => $height,
        ]);

        return $file->fdx;
    }
}

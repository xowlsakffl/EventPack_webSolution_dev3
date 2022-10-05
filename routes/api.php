<?php
use Illuminate\Http\Request;

// ==========================================================
// 인증부분
// ==========================================================
// ========== 개인 토큰 비할당 상태
//로그인
Route::post('/register', 'Auth\RegisterController@register');   //가입 요청
Route::post('/login', 'Auth\LoginController@login');    //로그인 요청

//소셜 로그인
Route::get('/social/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('/social/{provider}/callback', 'Auth\SocialController@handleProviderCallback');

//비밀번호 변경
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/email-check', 'Auth\ForgotPasswordController@emailCheckNumber');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//아이디 찾기
Route::post('users/email', 'Auth\UserFindController@sendUserLinkEmail');
Route::post('users/email-check', 'Auth\UserFindController@emailCheckNumber');

// ========== 개인 토큰 할당 상태
Route::middleware(['auth:api'])->group(function() 
{    
    //로그인
    Route::post('/logout', 'Auth\LoginController@logout');  //로그아웃
    
    //유저업데이트
    Route::middleware('password.check')->post('users', 'UserController@show');
    Route::post('users-update', 'UserController@update');

    Route::namespace('Admin')->group(function(){
        //웹사이트 목록
        Route::get('/works/{wdx}/sites' ,'Site\SiteController@index');
        
        //웹사이트 생성
        Route::post('/works/{wdx}/sites' ,'Site\SiteController@store');

        Route::prefix('sites/{sdx}')->group(function(){

            //특정 웹사이트
            Route::get('', 'Site\SiteController@show');

            //웹사이트 수정
            Route::put('', 'Site\SiteController@update');

            //웹사이트 사용자 분류관리
            Route::get('type-users', 'Site\SiteUserController@userTypeList');
            
            //웹사이트 사용자 자격관리
            Route::get('condition-users', 'Site\SiteUserController@userConditionList');

            //웹사이트 특정 사용자
            Route::post('users', 'Site\SiteUserController@userStore');
            Route::get('users/{sudx}', 'Site\SiteUserController@userShow');
            Route::put('users/{sudx}', 'Site\SiteUserController@userUpdate');

            //웹사이트 사용자 분류설정
            Route::resource('types', 'Site\SiteUserTypeController')->parameters([
                'types' => 'sutdx'
            ]);

            //웹사이트 사용자 자격설정
            Route::resource('conditions', 'Site\SiteUserConditionController')->parameters([
                'conditions' => 'sucdx'
            ]);

            //웹사이트 설정
            Route::put('sets', 'Site\SiteLayoutSetController@update');
            Route::get('sets', 'Site\SiteLayoutSetController@show');
            
            //웹사이트 메뉴 설정
            Route::resource('navigations', 'Site\SiteNavigationController')->only(['index', 'store', 'update', 'show', 'destroy'])->parameters([
                'navigations' => 'sndx'
            ]);

            //웹사이트 기능 설정
            Route::resource('tasks', 'Site\SiteTaskController')->only(['index', 'store', 'update', 'show', 'destroy'])->parameters([
                'tasks' => 'stdx'
            ]);

        });
        
        //WORK
        Route::resource('works', 'Work\WorkController')->only(['index', 'store', 'update', 'destroy'])->parameters([
            'works' => 'wdx'
        ]);
        
        //LAYOUT
        Route::resource('layouts', 'Layout\LayoutController')->only(['index', 'show'])->parameters([
            'layouts' => 'lodx'
        ]);

        Route::resource('layout-tops', 'Layout\LayoutTopController')->only(['index', 'show'])->parameters([
            'layout-tops' => 'lotdx'
        ]);

        Route::resource('layout-navigations', 'Layout\LayoutNaviController')->only(['index', 'show'])->parameters([
            'layout-navigations' => 'londx'
        ]);

        Route::resource('layout-middles', 'Layout\LayoutMiddleController')->only(['index', 'show'])->parameters([
            'layout-middles' => 'lomdx'
        ]);

        Route::resource('layout-bottoms', 'Layout\LayoutBottomController')->only(['index', 'show'])->parameters([
            'layout-bottoms' => 'lobdx'
        ]);

        Route::resource('layout-etcs', 'Layout\LayoutEtcController')->only(['index', 'show'])->parameters([
            'layout-etcs' => 'loedx'
        ]);
    });
});

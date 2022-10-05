<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    const VERIFIED = 'Y';
    const UNVERIFIED = 'N';

    const ADMIN = 'Y';
    const REGULAR = 'N';

    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const SECESSION = 1;
    const DELETE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'udx';
    protected $fillable = [
        'uid', 'password', 'name', 'email', 'email_auth', 'cell', 'cell_auth', 'tel', 'country', 'join_from', 'super', 'state', 'remember_token', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //유저는 여러개의 로그를 갖는다
    public function userActionLogs()
    {
        return $this->hasMany('App\UserActionLog', 'udx');
    }
    //유저는 여러개의 파일을 갖는다
    public function files()
    {
        return $this->hasMany('App\File', 'udx');
    }
    //유저는 여러개의 파일을 갖는다
    public function fileDownloadLogs()
    {
        return $this->hasMany('App\FileDownloadLog', 'udx');
    }

    public function works()
    {
        return $this->hasMany('App\Work', 'udx');
    }

    //User 모델
    public function sites()
    {
        return $this->hasManyThrough(
            'App\Site', 
            'App\Work',
            'udx',//works 테이블 외래키
            'wdx',//sites 테이블 외래키키
            'udx',//users 테이블 기본키
            'wdx' //works 테이블 기본키
        );
    }

    public function siteUsers()
    {
        return $this->hasMany('App\SiteUser', 'udx');
    }

}

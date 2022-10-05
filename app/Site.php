<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    const DEFAULT = 0;
    
    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $primaryKey = 'sdx';

    protected $fillable = [
       'wdx' ,'name', 'domain', 'email_name', 'email_address', 'phone_name', 'phone_address', 'title', 'description', 'keyword', 'favicon_fdx', 'og_title', 'og_url', 'og_description', 'og_images', 'meta', 'saving_events_pack', 'use_email_auth', 'main_user_policy', 'seperate_user_policy', 'state'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function work()
    {
        return $this->belongsTo('App\Work', 'wdx');
    }

    public function siteFavicon()
    {
        return $this->belongsTo('App\File', 'favicon_fdx');
    }

    public function siteOgImage()
    {
        return $this->belongsTo('App\File', 'og_images');
    }

    public function siteUserTypes()
    {
        return $this->hasMany('App\SiteUserType', 'sdx');
    }

    public function siteUserConditions()
    {
        return $this->hasMany('App\SiteUserCondition', 'sdx');
    }

    public function siteUsers()
    {
        return $this->hasMany('App\SiteUser', 'sdx');
    }

    public function siteLayoutSets()
    {
        return $this->hasOne('App\SiteLayoutSet', 'sdx');
    }

    public function siteNavigations()
    {
        return $this->hasMany('App\SiteNavigation', 'sdx');
    }

    public function siteTasks()
    {
        return $this->hasMany('App\SiteTask', 'sdx');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteUser extends Model
{
    use SoftDeletes;

    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const DELETE = 0;

    const VERIFIED = "Y";
    const UNVERIFIED = "N";

    const OWNER = "O";
    const ADMIN = "Y";
    const NA = "N";

    protected $primaryKey = 'sudx';
    protected $fillable = [
        'sdx', 'udx', 'name', 'email', 'email_auth', 'cell', 'cell_auth', 'admin_level', 'sutdx', 'sucdx', 'state',
    ];

    protected $casts = [
        'sutdx' => 'array',
        'sucdx' => 'array'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site', 'sdx');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }

    public function siteUserTypes()
    {
        return $this->morphedByMany('App\SiteUserType', 'site_userable');
    }

    public function siteUserConditions()
    {
        return $this->morphedByMany('App\SiteUserCondition', 'site_userable');
    }
}

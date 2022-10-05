<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteUserType extends Model
{
    use SoftDeletes;

    const ADMIN = "A";
    const REGISTOR = "U";
    const UNREGISTOR = "G";
    const NONE = "N";

    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $primaryKey = 'sutdx';
    protected $fillable = [
        'sdx', 'name', 'explain', 'state',
    ];

    public function site()
    {
        return $this->belongsTo('App\Site', 'sdx');
    }

    public function siteUsers()
    {
        return $this->morphToMany('App\SiteUser', 'site_userable');
    }
}

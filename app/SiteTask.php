<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteTask extends Model
{
    use SoftDeletes;

    const DEFAULT = 0;
    
    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $primaryKey = 'stdx';

    protected $fillable = [
        'rstdx', 'sdx', 'pdx', 'language', 'sndx', 'parent', 'sequence', 'name', 'use_layout', 'rewrite', 'readable_admins', 'editable_admins', 'permissions', 'state', 
    ];

    protected $casts = [
        'readable_admins' => 'array',
        'editable_admins' => 'array',
        'permissions' => 'array',
    ];

    public function site()
    {
        return $this->belongsTo('App\Site', 'sdx');
    }

    public function siteNavigation()
    {
        return $this->belongsTo('App\SiteNavigation', 'sndx');
    }


    public function packPages()
    {
        return $this->hasMany('App\PackPage', 'stdx');
    }

    public function packBoards()
    {
        return $this->hasMany('App\PackBoard', 'stdx');
    }
}

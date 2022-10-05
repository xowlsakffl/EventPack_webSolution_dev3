<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteNavigation extends Model
{
    use SoftDeletes;
    
    const DEFAULT = 0;
    
    const NORMAL = 10;
    const STOP = 9;
    const DELETE = 0;

    protected $primaryKey = 'sndx';

    protected $fillable = [
        'sdx', 'parent', 'depth', 'sequence', 'name', 'destination_stdx', 'destination_url', 'new_window', 'state', 
    ];

    public function site()
    {
        return $this->belongsTo('App\Site', 'sdx');
    }

    public function siteTask()
    {
        return $this->hasOne('App\SiteTask', 'sndx');
    }

    public function childs()
    {
        return $this->hasMany('App\SiteNavigation', 'parent');
    }

    public function parent()
    {
        return $this->belongsTo('App\SiteNavigation', 'parent');
    }
}

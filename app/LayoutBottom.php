<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutBottom extends Model
{
    const DEFAULT = 0;
    
    const NORMAL = 10;
    const UNPRINT = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $primaryKey = 'lobdx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'html', 'css', 'state',
    ];

    public function siteLayoutSets()
    {
        return $this->hasMany('App\SiteLayoutSet', 'lobdx');
    }

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'lobdx');
    }
}

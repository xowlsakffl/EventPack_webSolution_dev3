<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    const DEFAULT = 0;
    
    const NORMAL = 10;
    const UNPRINT = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $primaryKey = 'lodx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'descript_ko', 'descript_en', 'lotdx', 'londx', 'lomdx', 'lobdx', 'loedx', 'default', 'state'
    ];

    public function siteLayoutSets()
    {
        return $this->hasMany('App\SiteLayoutSet', 'lodx');
    }

    public function layoutTops()
    {
        return $this->belongsTo('App\LayoutTop', 'lotdx');
    }

    public function layoutNavagations()
    {
        return $this->belongsTo('App\Navagation', 'londx');
    }

    public function layoutMiddles()
    {
        return $this->belongsTo('App\Middle', 'lomdx');
    }

    public function layoutBottoms()
    {
        return $this->belongsTo('App\Bottom', 'lobdx');
    }

    public function layoutEtcs()
    {
        return $this->belongsTo('App\LayoutEtc', 'loedx');
    }
}

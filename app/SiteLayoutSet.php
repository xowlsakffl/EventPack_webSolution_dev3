<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteLayoutSet extends Model
{
    use SoftDeletes;

    const DEFAULT = 0;
    
    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const DELETE = 0;

    protected $fillable = [
        'sdx', 'lodx', 'lotdx', 'top_html', 'top_css', 'londx', 'navigation_html', 'navigation_css', 'use_site_menu', 'lomdx', 'middle_html', 'middle_css', 'lobdx', 'bottom_html', 'bottom_css', 'loedx', 'display_type', 'display_duration', 'font_default', 'font_resource', 'state'
    ];

    public function site()
    {
        return $this->belongsTo('App\Site', 'sdx');
    }

    public function layouts()
    {
        return $this->belongsTo('App\Layout', 'lodx');
    }

    public function layoutTops()
    {
        return $this->belongsTo('App\LayoutTop', 'lotdx');
    }

    public function layoutNavagations()
    {
        return $this->belongsTo('App\LayoutNavigation', 'londx');
    }

    public function layoutMiddles()
    {
        return $this->belongsTo('App\LayoutMiddle', 'lomdx');
    }

    public function layoutBottoms()
    {
        return $this->belongsTo('App\LayoutBottom', 'lobdx');
    }

    public function layoutEtcs()
    {
        return $this->belongsTo('App\LayoutEtc', 'loedx');
    }
}

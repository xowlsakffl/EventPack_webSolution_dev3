<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LayoutEtc extends Model
{
    const DEFAULT = 0;
    
    const NORMAL = 10;
    const UNPRINT = 9;
    const STOP = 8;
    const DELETE = 0;

    const FONTDEFAULT =  "\"Nanum Gothic\", arial, sans-serif";
    const FONTRESOURCE = "@import url(\"https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;800&display=swap\")";
    protected $primaryKey = 'loedx';
    protected $fillable = [
        'category', 'name_ko', 'name_en', 'code', 'display_type', 'display_duration', 'font_default', 'font_resource', 'state',
    ];

    public function siteLayoutSets()
    {
        return $this->hasMany('App\SiteLayoutSet', 'loedx');
    }

    public function layouts()
    {
        return $this->hasMany('App\Layout', 'loedx');
    }
}

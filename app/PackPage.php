<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackPage extends Model
{
    const DEFAULT = 0;

    const NORMAL = 10;
    const STOP = 9;
    const DELETE = 0;

    protected $table = 'pack_page';

    protected $fillable = [
        'stdx', 'title', 'content', 'files', 'udx', 'name', 'ip', 'show_this', 'state'
    ];

    public function siteTask()
    {
        return $this->belongsTo('App\SiteTask', 'stdx');
    }
}

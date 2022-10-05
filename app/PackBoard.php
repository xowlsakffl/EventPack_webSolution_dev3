<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackBoard extends Model
{
    const DEFAULT = 0;

    const NORMAL = 10;
    const STOP = 9;
    const DELETE = 0;

    protected $table = 'pack_board';

    protected $fillable = [
        'stdx', 'title', 'content', 'files', 'udx', 'name', 'password', 'ip', 'show_this', 'secret', 'notice', 'state'
    ];

    public function siteTask()
    {
        return $this->belongsTo('App\SiteTask', 'stdx');
    }

}

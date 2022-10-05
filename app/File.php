<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    
    const DEFAULT = 0;

    const NORMAL = 10;
    const TEMPORARY = 9;
    const DELETE = 0;

    protected $primaryKey = 'fdx';
    protected $fillable = [
        'udx', 'url', 'up_name', 'real_name', 'size', 'extension', 'download', 'width', 'height', 'state',
    ];
    //파일은 하나의 유저에 속한다
    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }
    //파일 
    public function fileDownloadLogs()
    {
        return $this->hasMany('App\FileDownloadLog', 'fdx');
    }

    public function siteFavicon()
    {
        return $this->hasOne('App\Site', 'favicon_fdx');
    }

    public function siteOgImage()
    {
        return $this->hasOne('App\Site', 'og_images');
    }
}

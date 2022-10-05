<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileDownloadLog extends Model
{
    const DEFAULT = 0;

    public $timestamps = ["created_at"];

    protected $fillable = [
        'fdx', 'udx', 'ip', 
    ];

    public function file()
    {
        return $this->belongsTo('App\File', 'fdx');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }
}

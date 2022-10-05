<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use SoftDeletes;

    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const EXPIRATION = 7;
    const DELETE = 0;

    protected $primaryKey = 'wdx';

    protected $fillable = [
        'udx', 'name', 'participant', 'duration', 'state',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }

    public function sites()
    {
        return $this->hasMany('App\Site', 'wdx');
    }
}

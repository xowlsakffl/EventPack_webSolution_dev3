<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActionLog extends Model
{
    const NORMAL = 10;
    const WAITING = 9;
    const STOP = 8;
    const SECESSION = 1;
    const DELETE = 0;

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    protected $fillable = [
        'udx', 'action', 'content', 'ip', 'ua', 'state'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'udx');
    }
}

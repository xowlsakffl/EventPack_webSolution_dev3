<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailCheck extends Model
{
    use SoftDeletes;

    const ID = 'id';
    const PW = 'pw';
    const AUTH = 'auth';
    
    protected $fillable = [
        'type', 'email', 'check_number', 'token',
    ];   

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }
}

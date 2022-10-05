<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    const NORMAL = 10;
    const STOP = 9;
    const DELETE = 0;

    protected $primaryKey = 'pdx';
    protected $fillable = [
        'kor_name', 'kor_explain', 'eng_name', 'eng_explain', 'path', 'readable_actions', 'editable_actions', 'state',
    ];

    protected $casts = [
        'readable_actions' => 'array',
        'editable_actions' => 'array',
    ];

}
